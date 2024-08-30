<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\auth\LoginController;

Route::post('/login',[LoginController::class, 'LoginHandler']);