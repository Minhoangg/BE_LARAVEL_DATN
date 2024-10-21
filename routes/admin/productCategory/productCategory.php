<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\productCategory\ProductCategoryController;

Route::prefix('/product-category')->group(function () {
    Route::get('/list', [ProductCategoryController::class, 'index']); //->middleware('auth.jwt')
    Route::get('/update/{id}', [ProductCategoryController::class, 'update']); //->middleware('auth.jwt')
    Route::put('/update/{id}', [ProductCategoryController::class, 'store']);
    Route::delete('/delete/{id}', [ProductCategoryController::class, 'destroy']); //->middleware('auth.jwt')
    Route::post('/create', [ProductCategoryController::class, 'create']); //->middleware('auth.jwt')
});
