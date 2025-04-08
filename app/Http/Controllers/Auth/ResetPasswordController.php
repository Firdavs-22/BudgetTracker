<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
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

        $user = User::where('email', $validated['email'])->first();
        $token = Str::random(6);
        $user->sendPasswordResetNotification($token);
//        $response = Password::broker()->sendResetLink([
//            'email' => $validated['email'],
//        ]);


//        $status = Password::sendResetLink([
//            'email' => $validated['email'],
//        ]);
//
//        return $status == Password::RESET_LINK_SENT
//            ? back()->with('status', __($status))
//            : back()->withInput($request->only('email'))
//                ->withErrors(['email' => __($status)]);
        return back();
    }


}

//
