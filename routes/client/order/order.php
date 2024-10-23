<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\client\order\OrderController;

Route::prefix('/order')->group(function () {
    Route::get('/getAllOrderByStatus', [OrderController::class, 'getOrderByStatus'])->middleware('auth.jwt');
    Route::get('/getById/{id}', [OrderController::class, 'getByOrderId'])->middleware('auth.jwt');
    Route::post('/createOrder',  [OrderController::class, 'createHandle'])->middleware('auth.jwt');
});


