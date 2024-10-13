<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\order\OrderController;

Route::prefix('/order')->group(function () {
    Route::get('/getAllOrderByStatus', [OrderController::class, 'getOrderByStatus']);
});
