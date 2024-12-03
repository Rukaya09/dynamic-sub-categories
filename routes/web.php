<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class);
Route::post('category/store',[CategoryController::class, 'store'])->name('category.store');
Route::get('/get-subcategories/{parentId}', [CategoryController::class, 'getSubCategories']);

Route::get('/', function () {
    return view('welcome');
});
