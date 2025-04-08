<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia("Home/Index");
})->name("dashboard");

Route::middleware("guest")->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::post("/register", "register");
        Route::get("/register", "page")->name("register");
    });

    Route::controller(LoginController::class)->group(function () {
        Route::post("/login", "login");
        Route::get("/login", "page")->name("login");
    });
});


Route::middleware("auth")->group(function () {
    Route::post("/logout", [LoginController::class, "logout"])->name("logout");
});
