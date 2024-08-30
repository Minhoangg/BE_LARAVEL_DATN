<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\auth\LoginController;

Route::post('/login',[LoginController::class, 'LoginHandler']);