<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\variantAttribute\VariantAttributeController;

Route::prefix('/variant-attribute')->group(function () {
    Route::get('/list/{id}', [VariantAttributeController::class, 'index']);
    Route::post('/create', [VariantAttributeController::class, 'create']);
    Route::delete('/delete/{id}', [VariantAttributeController::class, 'destroy']);
    Route::get('/update/{id}', [VariantAttributeController::class, 'update']);
    Route::put('/update/{id}', [VariantAttributeController::class, 'store']);
});
