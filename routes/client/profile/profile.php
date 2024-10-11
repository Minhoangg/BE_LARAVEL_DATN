<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\profile\ProfileController;

Route::prefix('profile')->group(function () {
    Route::put('/edit', [ProfileController::class, 'updateHandle'])->middleware('auth.jwt');
});
