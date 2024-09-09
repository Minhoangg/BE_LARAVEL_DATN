<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\auth\GoogleController;

Route::get('/auth/google/url',[GoogleController::class, 'index']);