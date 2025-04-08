<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendResetPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
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

        $response = Password::broker()->sendResetLink([
            'email' => $validated['email'],
        ]);

        dd($response);


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
