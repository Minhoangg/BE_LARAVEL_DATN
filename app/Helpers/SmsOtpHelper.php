<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class SmsOtpHelper
{

    private const SMS_API_URL = 'https://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_post_json/';
    private const ApiKey = 'B1D02433C3F6ECF46C594D498DFB88';
    private const SecretKey = '6AF80B5D49187DE491BF36FE346434';

    public static function sendSms($phone_number, $otp)
    {

        $phone_numbers = (string) $phone_number;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_post_json/', [
            "ApiKey" => '888EFEF4A94C363674142F8FBB5BA3',
            "Content" => $otp . ' la ma xac minh dang ky Baotrixemay cua ban',
            "Phone" =>  $phone_numbers,
            "SecretKey" => 'F8A6BEFAA0145C27911FB1124FFAEE',
            "Brandname" => "Baotrixemay",
            "SmsType" => "2",
        ]);

        return $response;
    }
}
