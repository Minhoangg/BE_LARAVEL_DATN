<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Helpers\CreateTokenHelper;
use Illuminate\Http\Request;
use App\Models\AdminAccountModel;
use App\Http\Resources\admin\auth\AdminLoginResource;

class VerifyOtpController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $otpFromRequest = $request->input('code');

        $user = AdminAccountModel::where('phone_number', $phoneNumber)->first();

        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }

        if ($otpFromRequest !== $user->otpCode) {
            return $this->errorResponse('Invalid OTP', 400);
        }

        $user->otpCode = null;

        $user->save();

        $token = CreateTokenHelper::createTokenAdmin($user);

        return $this->successResponse( $token, $user);
    }

    private function successResponse($token, $user)
    {
        return response()->json(array_merge([
            'status' => 200,
            'message' => 'OTP verified successfully',
            'token' => $token,
            'user' => new AdminLoginResource($user),
        ]),200);
    }

    private function errorResponse($message, $statusCode)
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
        ], $statusCode);
    }
}
