<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


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
    Route::get('/', function () {
        return Inertia("Home/Index");
    })->name('home');

    Route::controller(DashboardController::class)->group(function () {
        Route::get("/dashboard", "index")->name("dashboard");
    });

    Route::controller(AccountController::class)->group(function () {
        Route::get("/account", "index")->name("account.index");
        Route::get("/account/create", "create")->name("account.create");
        Route::get("/account/{account_id}", "update")->where("account_id", "[0-9]+")->name("account.update");

        Route::post("/account/change", "select");
        Route::post("/account/create", "store");
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get("/category", "index")->name("category.index");
    });

    Route::post("/logout", [LoginController::class, "logout"])->name("logout");
});
