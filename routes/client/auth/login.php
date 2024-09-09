<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\auth\ClientLoginController;

Route::post('/login',[ClientLoginController::class, 'LoginHandler']);