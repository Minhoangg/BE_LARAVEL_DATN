<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\client\order\OrderController;

Route::prefix('/order')->group(function () {
    Route::get('/getAllOrderByStatus', [OrderController::class, 'getOrderByStatus']);
    Route::post('/createOrder',  [OrderController::class, 'createHandle'])->middleware('auth.jwt');
});


