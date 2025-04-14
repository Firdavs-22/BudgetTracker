<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->group(function () {
    Route::get("/category", "index")->name("category.index");
    Route::get("/category/list", "list")->name("category.list");
    Route::get("/category/{category_id}", "view")->where("category_id", "[0-9]+")->name("category.view");
    Route::get("/category/create", "create")->name("category.create");
    Route::get("/category/edit/{category_id}", "update")->name("category.update")->where("category_id", "[0-9]+");

    Route::post("/category", "store");
    Route::put("/category/{category_id}", "edit")->where("category_id", "[0-9]+");
    Route::delete("/category/{category_id}", "delete")->where("category_id", "[0-9]+");
});

Route::controller(TransactionController::class)->group(function () {
    Route::get("/transaction", "index")->name("transaction.index");
    Route::get("/transaction/list", "list")->name("transaction.list");
    Route::get("/transaction/{transaction_id}", "view")->where("transaction_id", "[0-9]+")->name("transaction.view");
    Route::get("/transaction/create", "create")->name("transaction.create");
    Route::get("/transaction/edit/{transaction_id}", "update")->name("transaction.update")->where("transaction_id", "[0-9]+");

    Route::post("/transaction", "store");
    Route::put("/transaction/{transaction_id}", "edit")->where("transaction_id", "[0-9]+");
    Route::delete("/transaction/{transaction_id}", "delete")->where("transaction_id", "[0-9]+");
});
