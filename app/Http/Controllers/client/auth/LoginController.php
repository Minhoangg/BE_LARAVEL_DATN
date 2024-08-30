<?php

namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\admin\auth\LoginResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class LoginController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function LoginHandler(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = Auth::guard('user')->attempt($credentials)) {
            $user = Auth::user();

            return response()->json([
                'token' => $token,
                'user' => new LoginResource($user)
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
