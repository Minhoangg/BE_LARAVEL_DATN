<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\Admin\Auth\LoginResource;

class GoogleController extends Controller
{
    /**
     * Hiển thị thông tin hồ sơ của người dùng nếu token còn hiệu lực.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        
    }
}
