<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\posts\PostController;

Route::resource('posts',PostController::class);
