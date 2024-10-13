<?php

namespace App\Http\Controllers\admin\order;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use App\Models\StatusOrder;

class OrderController extends Controller
{

    public function getOrderByStatus()
    {
        $orders = StatusOrder::find(1)->orders;

        return response()->json(['orders' => $orders]);
    }

    public function getProductByOrder()
    {
        $products = OrderModel::find(1)->products;

        return response()->json(['products' => $products]);
    }
}
