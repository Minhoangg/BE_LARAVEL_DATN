<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\product\ProductController;

Route::prefix('/product')->group(function () {
    Route::get('/list/{id}', [ProductController::class, 'index']); //->middleware('auth.jwt')
    Route::get('/update/{id}', [ProductController::class, 'update']); //->middleware('auth.jwt')
    Route::put('/update/{id}', [ProductController::class, 'store']);
    Route::delete('/delete/{id}', [ProductController::class, 'destroy']); //->middleware('auth.jwt')
    Route::post('/create', [ProductController::class, 'create']); //->middleware('auth.jwt')
    Route::get('detail/{id}', [ProductController::class, 'detail']); //->middleware('auth.jwt')
});
