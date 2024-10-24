<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\client\payment\PaymentController;

Route::post('payment', [PaymentController::class, 'paymentHandle']);
Route::post('paymentHook', [PaymentController::class, 'paymentHook']);
Route::get('seepaygetbyid/{id}', [PaymentController::class, 'getbyid']);
Route::post('checkPayment', [PaymentController::class, 'checkPayment']);