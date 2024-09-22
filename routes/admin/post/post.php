<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\posts\PostController;
use App\Http\Controllers\admin\posts\PostCommentController;
use App\Http\Controllers\admin\posts\PostCategoryController;

Route::resource('posts',PostController::class);

//route post_comment
Route::resource('post_comments',PostCommentController::class);
//route post_category
Route::resource('post_categories',PostCategoryController::class);
Route::post('post_comments/reply/{commentId}', [PostCommentController::class, 'reply'])->name('post_comments.reply');
