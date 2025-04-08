<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::query()->create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'phone' => $validated['phone'],
        ]);

        Auth::login($user, $validated['remember']);

        return redirect()
            ->intended("/dashboard")
            ->with("success", "Registration successful. Welcome to the application!");
    }

    public function page(): Response
    {
        return Inertia::render('Auth/Register');
    }
}
