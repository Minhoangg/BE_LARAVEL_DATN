<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\user\UserController;

Route::prefix('/user')->group(function () {
    Route::get('/list', [UserController::class, 'index']);
    Route::put('/update/{id}', [UserController::class, 'update']);
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->middleware('auth.jwt');
});
