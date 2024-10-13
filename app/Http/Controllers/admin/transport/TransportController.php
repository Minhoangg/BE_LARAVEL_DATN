<?php

namespace App\Http\Controllers\admin\transport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\admin\transport\TransportRepository;
use App\Models\OrderModel;
use Illuminate\Support\Facades\Http;
use App\Models\StatusOrder;
use App\Http\Requests\Admin\transport\TransportRequest;



class TransportController extends Controller
{
    protected $transportRepository;

    function __construct(TransportRepository $transportRepository)
    {
        $this->transportRepository = $transportRepository;
    }

    private function getDataProductByOrderId($order_id)
    {
        $orders = OrderModel::find($order_id)->products;

        $products = $orders->map(function ($product) {
            return [
                'name' => $product->name,
                'quantity' => $product->quantity,
            ];
        });

        return $products;
    }

    private function getInforUserByOrderId($order_id)
    {
        $orders = OrderModel::find($order_id)->user;

        return $orders;
    }

    private function getPivotByOrderId($order_id)
    {
        $pivots = OrderModel::find($order_id)->products;

        $total = $pivots->sum(function ($product) {
            return $product->pivot->total;
        });

        return $total;
    }

    private function getOrderAddressById($order_id)
    {
        $order = OrderModel::find($order_id);
        if ($order) {
            return [
                'address' => $order->street_address,
                'ward_name' => $order->ward_code,
                'district_name' => $order->district_code,
                'province_name' => $order->province_code,
            ];
        }

        return null; // Return null if order is not found
    }


    public function createTransport(TransportRequest $request)
    {

        $userInfor = $this->getInforUserByOrderId($request->order_id);

        $total = $this->getPivotByOrderId($request->order_id);

        $orderAddress = $this->getOrderAddressById($request->order_id); // Get order address


        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Token' => '654cd50c-75b5-11ef-8e53-0a00184fe694',
            'ShopId' => 194614
        ])->post(
            'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create',
            [
                "payment_type_id" => $request->payment_type_id,
                "note" => $request->note,
                "required_note" => $request->required_note,
                "return_phone" => "0947702541",
                "return_address" => "Toà nhà FPT Polytechnic, Đ. Số 22, Thường Thạnh, Cái Răng, Cần Thơ",
                "client_order_code" => "",
                "to_name" => $userInfor['name'],
                "to_phone" => $userInfor['phone_number'],
                "to_address" => $orderAddress['address'],
                "to_ward_name" => $orderAddress['ward_name'],
                "to_district_name" => $orderAddress['district_name'],
                "to_province_name" => $orderAddress['province_name'],
                "cod_amount" => $total,
                "content" => $request->contents,
                "weight" => 200,
                "length" => 20,
                "width" => 8,
                "height" => 10,
                "cod_failed_amount" => $request->cod_failed_amount,
                "pick_station_id" => 1444,
                "deliver_station_id" => null,
                "insurance_value" => 5000000,
                "service_id" => 0,
                "service_type_id" => 2,
                "coupon" => null,
                "pickup_time" => $request->pickup_time,
                "pick_shift" => $request->pick_shift,
                "items" => $this->getDataProductByOrderId($request->order_id),
            ]
        );

        return response()->json(['response' => $response['data']]);
    }
}
