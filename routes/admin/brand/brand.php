<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\brand\brandController;

Route::prefix('/brand')->group(function () {
    Route::get('/list', [brandController::class, 'index']); //->middleware('auth.jwt')
    Route::get('/update/{id}', [brandController::class, 'update']); //->middleware('auth.jwt')
    Route::put('/update/{id}', [brandController::class, 'updateData']);
    Route::delete('/delete/{id}', [brandController::class, 'destroy']); //->middleware('auth.jwt')
    Route::get('/data-for-create', [brandController::class, 'getCategories']); //->middleware('auth.jwt')
    Route::post('/create', [brandController::class, 'store']); //->middleware('auth.jwt')
});
