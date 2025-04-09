<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia("Home/Index");
})->name('home');

Route::middleware("guest")->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::post("/register", "register");
        Route::get("/register", "page")->name("register");
    });

    Route::controller(LoginController::class)->group(function () {
        Route::post("/login", "login");
        Route::get("/login", "page")->name("login");
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get("/forgot-password", "forgotPage")->name("password.forgot");
        Route::post("/forgot-password", "send");
        Route::post("/reset-password", "reset");
    });
});


Route::middleware("auth")->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get("/dashboard", "index")->name("dashboard");
        Route::get("/dashboard/{id}", "show")->name("dashboard.show");
    });

    Route::post("/logout", [LoginController::class, "logout"])->name("logout");
});
