<?php

namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use App\Helpers\CreateTokenHelper;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyOtpController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $otpFromRequest = $request->input('code');

        $user = User::where('phone_number', $phoneNumber)->first();

        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }

        if ($otpFromRequest !== $user->optCode) {
            return $this->errorResponse('Invalid OTP', 400);
        }

        $user->optCode = null;

        $user->save();

        $token = CreateTokenHelper::createTokenClient($user);

        return $this->successResponse('OTP verified successfully', ['token' => $token], 200);
    }

    private function successResponse($message, $data = [], $statusCode = 200)
    {
        return response()->json(array_merge([
            'status' => $statusCode,
            'message' => $message,
        ], $data), $statusCode);
    }

    private function errorResponse($message, $statusCode)
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
        ], $statusCode);
    }
}
