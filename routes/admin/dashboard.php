<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-json', function () {
    return response()->json([
        'message' => 'Đây là một route trả về JSON',
        'status' => 'success',
        'data' => [
            'foo' => 'bar',
            'baz' => 'qux'
        ]
    ]);
})->middleware('auth.jwt');

