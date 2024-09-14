<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\post\ClientPostController;

Route::get('posts',[ClientPostController::class, 'index']);
