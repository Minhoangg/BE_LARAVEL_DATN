<?php

namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\client\auth\ClientLoginResource;
use App\Http\Requests\Client\ClientLoginRequest;
use Illuminate\Support\Facades\auth;
use App\Helpers\CreateTokenHelper;
use App\Helpers\SmsOtpHelper;
use Illuminate\Http\Request;
use App\Models\User;



class ClientLoginController extends Controller
{

    public function LoginHandler(ClientLoginRequest $request)
    {
        $credentials = $request->only('phone_number', 'password');

        if (!Auth::guard('user')->attempt($credentials)) {
            return $this->FailedAuthenticationResponse();
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->SaveOtp($otp, $request->only('phone_number'));

        $responseSendSms =  SmsOtpHelper::sendSms($request->phone_number,  $otp);

        if ($responseSendSms) {
            return $this->ResponseSms($responseSendSms, $otp);
        }

        return $this->SuccessAuthenticationResponse($otp);
    }

    private function SaveOtp($otp ,$phone_number){
        $user = User::where('phone_number', $phone_number)->first();

        $user->optCode = $otp;

        $user->save();
    }

    public function VerifyOtp(Request $request)
    {

        $phoneNumber = $request->input('phone_number');
        $otpFromRequest = $request->input('code');

        $user = User::where('phone_number', $phoneNumber)->first();

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found',
            ], 404);
        }

        if ($otpFromRequest == $user->optCode) {

            $token = CreateTokenHelper::createTokenClient($user);

            return response()->json([
                'status' => 200,
                'message' => 'OTP verified successfully',
                'token' => $token,
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid OTP',
            ], 400);
        }
    }

    private function FailedAuthenticationResponse()
    {
        return response()->json([
            'error' => 'Authentication failed',
            'status_code' => 401,
        ], 401);
    }

    private function ResponseSms($responseSendSms, $otp)
    {
        if ($responseSendSms['CodeResult'] == '100') {
            return response()->json([
                'success' => true,
                'message' => 'OTP send successfully',
                'otp' => $otp
            ], 200);
        }

            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP',
                'error_code' => $responseSendSms['code']
            ], 400);
    }

    private function SuccessAuthenticationResponse($otp)
    {
        return response()->json([
            'status_code' => 200,
            'message' => 'Mã otp đã được gửi đến số điện thoại của bạn',
            'otp' => $otp,
        ]);
    }
}
