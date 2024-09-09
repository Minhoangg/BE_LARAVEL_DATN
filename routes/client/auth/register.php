<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\auth\ClientRegisterController;

Route::post('/register',[ClientRegisterController::class, 'RegisterHandler']);