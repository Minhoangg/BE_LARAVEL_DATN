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

    public function getById($id)
    {
        try {
            $userId = JWTAuth::parseToken()->getPayload()->get('sub');
            $user = User::find($userId);

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $shippingAddress = ShippingAddressModel::find($id);

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

    public function updateHandle(ShippingAddressRequest $request, $id)
    {
        try {
            $userId = JWTAuth::parseToken()->getPayload()->get('sub');

            $user = User::find($userId)->shippingAddresses();

            $dataAddress = $user->find($id);

            if (!$userId) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            if (!$dataAddress) {
                return response()->json(['error' => 'No shipping address found with this ID.'], 404);
            }

            $dataAddress->update([
                'city' => $request->city,
                'district' => $request->district,
                'ward' => $request->ward,
                'street_address' => $request->street_address,
            ]);

            return response()->json([
                'message' => 'Shipping address updated successfully',
                'shipping_address' => $dataAddress
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not process the request', 'details' => $e->getMessage()], 500);
        }
    }
}
