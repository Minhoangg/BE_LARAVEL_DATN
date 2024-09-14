<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\auth\VerifyOtpController;

Route::post('/auth/verify-otp',[VerifyOtpController::class, 'VerifyOtp']);