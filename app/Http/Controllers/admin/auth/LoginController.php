<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\auth;

class LoginController extends Controller
{
    public function LoginHandler(AdminLoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if ($token = Auth::guard('admin')->attempt($credentials)) {
            return response()->json(['token' => $token], 200);
        }

    }
}
