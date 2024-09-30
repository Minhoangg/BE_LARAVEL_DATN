<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\variant\VariantController;

Route::prefix('/variant')->group(function () {
    Route::get('/list', [VariantController::class, 'index']); //->middleware('auth.jwt')
});
