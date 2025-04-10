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

        if (Auth::attempt([
            "email" => $credentials["email"],
            "password" => $credentials["password"]
            ], $credentials["remember"])
        ) {
            $request->session()->regenerate();
            return redirect()
                ->intended("/dashboard")
                ->with("success", "Login successful. Welcome back!");
        }

        return back()->withErrors([
            "email" => "Invalid credentials. Please try again.",
        ])->onlyInput("email");
    }

    public function page(): Response
    {
        return Inertia::render("Auth/Login");
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()
            ->route("login")
            ->with("success", "Logout successful. See you next time!");
    }
}
