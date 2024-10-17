<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\product\ProductController;

Route::prefix('/product')->group(function () {
    Route::get('/list/{id}', [ProductController::class, 'index']); //->middleware('auth.jwt')
    Route::put('/update-variant/{id}', [ProductController::class, 'updateVariant']); //->middleware('auth.jwt')
    Route::put('/update-simple/{id}', [ProductController::class, 'updateSimple']);
    Route::delete('/delete/{id}', [ProductController::class, 'destroy']); //->middleware('auth.jwt')
    Route::post('/create', [ProductController::class, 'create']); //->middleware('auth.jwt')
    Route::get('detail/{id}', [ProductController::class, 'detail']); //->middleware('auth.jwt')
    Route::get('/dataForCreate/{id}', [ProductController::class, 'dataForCreate']); //->middleware('auth.
    Route::get('/get-info-update/{id}', [ProductController::class, 'getInfoUpdate']); //->middleware('auth.
});
