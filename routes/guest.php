<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

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
