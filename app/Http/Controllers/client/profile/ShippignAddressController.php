<?php

namespace App\Http\Controllers\client\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Client\Profile\ShippingAddressRequest;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use App\Models\ShippingAddressModel;

class ShippignAddressController extends Controller
{

    public function getByUserId()
    {
        try {
            // Get the user ID from the JWT token
            $userId = JWTAuth::parseToken()->getPayload()->get('sub');
            $user = User::find($userId);
    
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
    
            // Retrieve the user's shipping address
            $shippingAddress = $user->shippingAddresses()->first();
    
            if (!$shippingAddress) {
                return response()->json(['message' => 'No shipping address found for this user.'], 404);
            }
    
            return response()->json([
                'message' => 'Shipping address retrieved successfully',
                'shipping_address' => $shippingAddress
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not process the request', 'details' => $e->getMessage()], 500);
        }
    }
    

    public function createHandle(ShippingAddressRequest $request)
    {
        try {
            $userId = JWTAuth::parseToken()->getPayload()->get('sub');
            $user = User::find($userId);

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            // Kiểm tra xem người dùng đã có địa chỉ giao hàng chưa
            if ($user->shippingAddresses()->exists()) {
                return response()->json(['message' => 'User already has a shipping address. Consider updating instead.'], 409);
            }

            // Nếu chưa có địa chỉ, tạo địa chỉ mới
            $shippingAddress = $user->shippingAddresses()->create([
                'city' => $request->city,
                'district' => $request->district,
                'ward' => $request->ward,
                'street_address' => $request->street_address,
                'user_id' => $user->id,
            ]);

            return response()->json([
                'message' => 'Shipping address created successfully',
                'shipping_address' => $shippingAddress
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not process the request', 'details' => $e->getMessage()], 500);
        }
    }

    public function updateHandle(ShippingAddressRequest $request)
    {
        try {
            $userId = JWTAuth::parseToken()->getPayload()->get('sub');
            $user = User::find($userId);

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            // Lấy địa chỉ giao hàng đầu tiên của người dùng
            $shippingAddress = $user->shippingAddresses()->first();

            if (!$shippingAddress) {
                return response()->json(['error' => 'No shipping address found. Please create one first.'], 404);
            }

            // Cập nhật địa chỉ
            $shippingAddress->update([
                'city' => $request->city,
                'district' => $request->district,
                'ward' => $request->ward,
                'street_address' => $request->street_address,
            ]);

            return response()->json([
                'message' => 'Shipping address updated successfully',
                'shipping_address' => $shippingAddress
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not process the request', 'details' => $e->getMessage()], 500);
        }
    }
}
