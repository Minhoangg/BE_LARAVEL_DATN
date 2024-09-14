<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\auth\VerifyOtpController;

Route::post('/auth/verify-otp',[VerifyOtpController::class, 'VerifyOtp']);