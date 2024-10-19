<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\brand\BrandController;

Route::prefix('/brand')->group(function () {
    Route::get('/list', [BrandController::class, 'index']); //->middleware('auth.jwt')
    Route::get('/update/{id}', [BrandController::class, 'update']); //->middleware('auth.jwt')
    Route::put('/update/{id}', [BrandController::class, 'updateData']);
    Route::delete('/delete/{id}', [BrandController::class, 'destroy']); //->middleware('auth.jwt')
    Route::get('/data-for-create', [BrandController::class, 'getCategories']); //->middleware('auth.jwt')
    Route::post('/create', [BrandController::class, 'store']); //->middleware('auth.jwt')
});
