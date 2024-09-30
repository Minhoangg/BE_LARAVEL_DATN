<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\cart\ClientCartController;

Route::resource('cart',ClientCartController::class);
