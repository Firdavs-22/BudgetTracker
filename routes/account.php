<?php

use App\Http\Controllers\CategoryController;
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
