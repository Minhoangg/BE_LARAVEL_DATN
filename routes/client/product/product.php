<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\product\ProductController;

Route::prefix('/product')->group(function () {
    Route::get('/list', [ProductController::class, 'show']); //->middleware('auth.jwt')
    Route::get('show-all-chill/{id}', [ProductController::class, 'showAllChill']); //->middleware
    Route::get('detail/{id}', [ProductController::class, 'detail']); //->middleware
});
