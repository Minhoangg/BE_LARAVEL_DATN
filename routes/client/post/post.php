<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\post\ClientPostController;

Route::resource('posts',ClientPostController::class);
