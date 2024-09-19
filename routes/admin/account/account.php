<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\account\AccountController;

Route::prefix('/admin-account')->group(function () {
    Route::get('/role', [AccountController::class, 'roleList']);
    Route::get('/list', [AccountController::class, 'index'])->middleware('auth.jwt');
    Route::get('/detail/{id}', [AccountController::class, 'show'])->middleware('auth.jwt');
    Route::post('/create', [AccountController::class, 'store'])->middleware('auth.jwt');
    Route::put('/update/{id}', [AccountController::class, 'update'])->middleware('auth.jwt');
    Route::delete('/delete/{id}', [AccountController::class, 'destroy'])->middleware('auth.jwt');
});