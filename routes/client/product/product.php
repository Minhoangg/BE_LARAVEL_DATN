<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\product\ProductController;

Route::get('product', [ProductController::class, 'show']);
