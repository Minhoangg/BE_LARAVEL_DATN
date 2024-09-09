<?php

namespace App\Helpers;

use Tymon\JWTAuth\Facades\JWTAuth;

class CreateTokenHelper {

    private const TOKEN_TTL_CLIENT = 480;
    private const TOKEN_TTL_ADMIN = 0;

    public static function createTokenClient($user)
    {
        JWTAuth::factory()->setTTL(self::TOKEN_TTL_CLIENT);
        return JWTAuth::fromUser($user);
    }

    public static function createTokenAdmin($user)
    {
        JWTAuth::factory()->setTTL(self::TOKEN_TTL_ADMIN);
        return JWTAuth::fromUser($user);
    }

}


