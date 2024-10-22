<?php

namespace App\Http\Controllers\client\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\Client\order\StoreOrderRequest;
use App\Models\Product;
use App\Models\OrderModel;
use App\Models\StatusOrder;


class OrderController extends Controller
{

    public function getOrderByStatus()
    {
        $orders = StatusOrder::find(2)->orders;

        return response()->json(['orders' => $orders]);
    }

    private function getPivotByOrderId($order_id)
    {
        $pivots = OrderModel::find($order_id)->products;

        $total = $pivots->sum(function ($product) {
            return $product->pivot->total;
        });

        return $total;
    }

    public function createHandle(StoreOrderRequest $request)
    {
        $userId = JWTAuth::parseToken()->getPayload()->get('sub');

        $totalAmount = 0;

        foreach ($request->products as $product) {
            $productModel = Product::find($product['product_id']);

            $itemTotal = $productModel->price_sale * $product['quantity'];

            $totalAmount += $itemTotal;
        }

        $order = OrderModel::create([
            'user_id' => $userId,
            'total' => $totalAmount,
            'status_id' => 1,
            'paymend_status_id' => 1,
            'sku_order' => $this->generateRandomSku(),
            'province_code' => $request->province_code,
            'district_code' => $request->district_code,
            'ward_code' => $request->ward_code,
            'street_address' => $request->street_address,
        ]);

        foreach ($request->products as $product) {
            $productModel = Product::find($product['product_id']);

            $price = $productModel->price_sale ?? $productModel->price;
            $itemTotal = $price * $product['quantity'];

            $order->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'price' => $price,
                'total' => $itemTotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        return response()->json(['message' => 'Order created successfully!', 'order' => $order], 201);
    }


    private function generateRandomSku()
    {
        $sku = 'MDH' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        return $sku;
    }
}
