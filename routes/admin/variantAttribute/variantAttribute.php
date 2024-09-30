<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\variantAttribute\VariantAttributeController;

Route::prefix('/variant-attribute')->group(function () {
    Route::get('/list/{id}', [VariantAttributeController::class, 'index']); //->middleware('auth.jwt')
});
