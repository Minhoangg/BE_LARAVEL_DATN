<?php

namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\client\auth\ClientRegisterResource;
use App\Http\Requests\Client\ClientRegisterRequest;
use Illuminate\Support\Facades\auth;
use App\Models\User;

class ClientRegisterController extends Controller
{

    public function RegisterHandler(ClientRegisterRequest $request)
    {
        $dataRequest = $request->only('name', 'phone_number', 'password');

        $user = User::create([
            'name' => $dataRequest['name'],
            'phone_number' => $dataRequest['phone_number'],
            'password' =>  bcrypt($dataRequest['password']),
        ]);

        if (!$user) {
            return $this->FailedRegisterResponse();
        }

        return $this->SuccessRegisterResponse($dataRequest['phone_number']);
    }


    public function FailedRegisterResponse()
    {
        return response()->json([
            'error' => 'Register failed',
            'status_code' => 401,
        ], 401);
    }


    private function SuccessRegisterResponse($phone_number)
    {
        $user = User::where('phone_number', '=', $phone_number)->first();

        return response()->json([
            'status_code' => 200,
            'message' => 'Register successful',
            'user' => new ClientRegisterResource($user),
        ]);
    }
}
