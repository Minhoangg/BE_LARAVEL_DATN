<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\auth\ClientRegisterController;

Route::post('/auth/register',[ClientRegisterController::class, 'RegisterHandler']);