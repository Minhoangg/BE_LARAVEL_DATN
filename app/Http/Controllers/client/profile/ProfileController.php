<?php

namespace App\Http\Controllers\client\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Client\Profile\EditProfileRequest;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{
    public function updateHandle(EditProfileRequest $request)
    {
        $userId = JWTAuth::parseToken()->getPayload()->get('sub');

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Người dùng không tồn tại!',
            ], 404);
        }

        $user->name = $request->input('name');
        $user->phone_number = $request->input('phoneNumber');

        if ($user->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thông tin thành công!',
                'data' => $user
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Cập nhật thông tin thất bại!',
        ], 500);
    }
}
