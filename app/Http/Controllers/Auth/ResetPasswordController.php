<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendResetPasswordRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ResetPasswordController extends Controller
{
    public function forgotPage(): Response
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    public function send(SendResetPasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::query()->where('email', $validated['email'])->first();
        $token = Str::random(6);
        $user->sendPasswordResetNotification($token);

        return back();
    }

    public function reset(ResetPasswordRequest $request)
    {
        $validated = $request->validated();

        $record = DB::table("password_reset_codes")
            ->where("email", $validated['email'])
            ->first();

        if (!$record || $record->code !== $validated['code']) {
            return back()->withErrors([
                'code' => 'Invalid verification code.',
            ]);
        }

        if (Carbon::parse($record->created_at)->addHour()->addMinutes(30)->isPast()) {
            return back()->withErrors([
                'code' => 'Verification code expired.',
            ]);
        }

        $user = User::query()->where('email', $validated['email'])->first();
        $user->password = $validated['password'];
        $user->save();

        DB::table("password_reset_codes")
            ->where("email", $validated['email'])
            ->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully.');
    }


}

