<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\user\UserController;

Route::prefix('/user')->group(function () {
    Route::get('/list', [UserController::class, 'index'])->middleware('auth.jwt');
    Route::get('/detail/{id}', [UserController::class, 'show'])->middleware('auth.jwt');
    Route::put('/update/{id}', [UserController::class, 'update'])->middleware('auth.jwt');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->middleware('auth.jwt');
});
