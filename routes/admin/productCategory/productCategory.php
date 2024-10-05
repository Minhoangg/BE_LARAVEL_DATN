<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\productCategory\productCategoryController;

Route::prefix('/product-category')->group(function () {
    Route::get('/list', [productCategoryController::class, 'index']); //->middleware('auth.jwt')
    Route::get('/update/{id}', [productCategoryController::class, 'update']); //->middleware('auth.jwt')
    Route::put('/update/{id}', [productCategoryController::class, 'store']);
    Route::delete('/delete/{id}', [productCategoryController::class, 'destroy']); //->middleware('auth.jwt')
    Route::post('/create', [productCategoryController::class, 'create']); //->middleware('auth.jwt')
});
