<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\transport\TransportController;

Route::prefix('/transport')->group(function () {
    Route::post('/createTransport', [TransportController::class, 'createTransport']);
});
