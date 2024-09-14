<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\auth\ClientLoginController;

Route::post('/auth/login',[ClientLoginController::class, 'LoginHandler']);