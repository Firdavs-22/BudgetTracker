<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mime\Address;

Route::get('/', function () {
//    Mail::raw("本文です。", function (Message $message) {
//        $message->to([
//            new Address("firdavsgaybullayev22@gmail.com", "Laravel")
//        ])->subject("テストメール");
//    });

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

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get("/forgot-password", "forgotPage")->name("password.forgot");
        Route::post("/forgot-password", "send")->name("password.email");
    });
});


Route::middleware("auth")->group(function () {
    Route::post("/logout", [LoginController::class, "logout"])->name("logout");
});
