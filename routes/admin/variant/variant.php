<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\variant\VariantController;

Route::prefix('/variant')->group(function () {
    Route::get('/list', [VariantController::class, 'index']); //->middleware('auth.jwt')
    Route::get('/update/{id}', [VariantController::class, 'update']); //->middleware('auth.jwt')
    Route::post('/update/{id}', [VariantController::class, 'store']);
    Route::delete('/delete/{id}', [VariantController::class, 'destroy']); //->middleware('auth.jwt')
    Route::post('/create', [VariantController::class, 'create']); //->middleware('auth.jwt')
    Route::get('/format-variant-data', [VariantController::class, 'formatVariantData']); //->middleware('auth.jwt')
});
