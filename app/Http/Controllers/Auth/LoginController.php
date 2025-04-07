<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginReqeust;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function login(LoginReqeust $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()
                ->intended("/dashboard")
                ->with("success", "Login successful. Welcome back!");
        }

        return redirect()
            ->back()
            ->with("error", "Invalid credentials. Please try again.");
    }

    public function page(): Response
    {
        return Inertia::render("Auth/Login");
    }
}
