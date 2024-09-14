<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\auth;
use App\Helpers\CreateTokenHelper;
use App\Helpers\SmsOtpHelper;
use Illuminate\Http\Request;
use App\Models\AdminAccountModel;

class AminLoginController extends Controller
{
    public function LoginHandler(Request $request)
    {
        $credentials = $request->only('phone_number', 'password');

        if (!Auth::guard('admin')->attempt($credentials)) {
            return $this->FailedAuthenticationResponse();
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->SaveOtp($otp, $request->only('phone_number'));

        // $responseSendSms =  SmsOtpHelper::sendSms($request->phone_number,  $otp);

        // if ($responseSendSms) {
        //     return $this->ResponseSms($responseSendSms, $otp);
        // }

        return $this->SuccessAuthenticationResponse($otp);
    }

    private function SaveOtp($otp ,$phone_number){
        $user = AdminAccountModel::where('phone_number', $phone_number)->first();

        $user->otpCode = $otp;

        $user->save();
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
