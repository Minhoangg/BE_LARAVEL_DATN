<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\profile\ShippignAddressController;

Route::prefix('shippingAddress')->group(function () {
    Route::get('/detail', [ShippignAddressController::class, 'getByUserId'])->middleware('auth.jwt');
    Route::post('/create', [ShippignAddressController::class, 'createHandle'])->middleware('auth.jwt');
    Route::post('/update', [ShippignAddressController::class, 'updateHandle'])->middleware('auth.jwt');
});
