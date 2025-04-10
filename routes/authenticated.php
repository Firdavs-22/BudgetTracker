<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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
    Route::put("/account/{account_id}", "edit")->where("account_id", "[0-9]+");
    Route::delete("/account/{account_id}", "delete")->where("account_id", "[0-9]+");
});

Route::post("/logout", [LoginController::class, "logout"])->name("logout");


Route::middleware("account")->group(__DIR__."/account.php");
