<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\profile\ProfileController;

Route::get('/profile',[ProfileController::class, 'show'])->middleware('auth.jwt');