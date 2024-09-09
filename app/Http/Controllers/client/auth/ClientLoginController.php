<?php

namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\client\auth\ClientLoginResource;
use App\Http\Requests\Client\ClientLoginRequest;
use Illuminate\Support\Facades\auth;
use App\Helpers\CreateTokenHelper;


class ClientLoginController extends Controller
{

    public function LoginHandler(ClientLoginRequest $request)
    {
        $credentials = $request->only('phone_number', 'password');

        if (!Auth::guard('user')->attempt($credentials)) {
            return $this->FailedLoginResponse();
        }

        $token = CreateTokenHelper::createTokenClient(Auth::guard('user')->user());

        return $this->SuccessLoginResponse($token);
    }


    public function FailedLoginResponse()
    {
        return response()->json([
            'error' => 'Authentication failed',
            'status_code' => 401,
        ], 401);
    }


    private function SuccessLoginResponse(string $token)
    {
        $user = Auth::guard('user')->user();

        return response()->json([
            'status_code' => 200,
            'message' => 'Login successful',
            'user' => new ClientLoginResource($user),
            'access_token' => $token,
        ]);
    }
}
