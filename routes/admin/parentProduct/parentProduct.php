<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\parentProduct\ParentProductController;

Route::prefix('/parent-product')->group(function () {
    Route::get('/list', [ParentProductController::class, 'index']); //->middleware('auth.jwt')
    Route::get('/update/{id}', [ParentProductController::class, 'update']); //->middleware('auth.jwt')
    Route::put('/update/{id}', [ParentProductController::class, 'store']);
    Route::get('/create', [ParentProductController::class, 'dataForCreate']); //->middleware('auth.
    Route::delete('/delete/{id}', [ParentProductController::class, 'destroy']); //->middleware('auth.jwt')
    Route::post('/create-simple-product', [ParentProductController::class, 'createSimpleProduct']); //->middleware('auth.jwt')
    Route::post('/create-product-variant', [ParentProductController::class, 'createProductVariant']);
    Route::get('detail/{id}', [ParentProductController::class, 'detail']); //->middleware('auth.jwt')
    Route::get('data-for-create', [ParentProductController::class, 'dataForCreate']);
    Route::get('get-product-variants/{id}', [ParentProductController::class, 'getProductVariants']);
});
