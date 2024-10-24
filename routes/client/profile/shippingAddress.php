<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\profile\ShippignAddressController;

Route::prefix('shippingAddress')->group(function () {
    Route::get('/getAll', [ShippignAddressController::class, 'getAll'])->middleware('auth.jwt');
    Route::get('/detail/{id}', [ShippignAddressController::class, 'getById'])->middleware('auth.jwt');
    Route::post('/create', [ShippignAddressController::class, 'createHandle'])->middleware('auth.jwt');
    Route::post('/update/{id}', [ShippignAddressController::class, 'updateHandle'])->middleware('auth.jwt');
    Route::delete('/delete/{id}', [ShippignAddressController::class, 'deleteHandle'])->middleware('auth.jwt');
});
