<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\auth\AminLoginController;

Route::post('/auth/login',[AminLoginController::class, 'LoginHandler']);