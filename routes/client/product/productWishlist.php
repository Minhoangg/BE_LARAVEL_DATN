<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\product\WishlistController;

Route::resource('wishlist', WishlistController::class);
