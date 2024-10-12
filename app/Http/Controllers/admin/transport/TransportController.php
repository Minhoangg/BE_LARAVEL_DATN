<?php

namespace App\Http\Controllers\admin\transport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\admin\transport\TransportRepository;
use App\Models\OrderModel;
use Illuminate\Support\Facades\Http;
use App\Models\StatusOrder;



class TransportController extends Controller
{
    protected $transportRepository;

    function __construct(TransportRepository $transportRepository)
    {
        $this->transportRepository = $transportRepository;
    }

    public function createTransport()
    {

        $orders = OrderModel::find(2)->products;

        $products = $orders->map(function ($product) {
            return [
                'name' => $product->name,
                'quantity' => $product->quantity,
            ];
        });

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Token' => '654cd50c-75b5-11ef-8e53-0a00184fe694',
            'ShopId' => 194614
        ])->post(
            'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create',
            [
                "payment_type_id" => 1,
                "note" => "HÀNG DỄ VỠ.",
                "required_note" => "CHOXEMHANGKHONGTHU",
                "return_phone" => "0947702541",
                "return_address" => "Toà nhà FPT Polytechnic, Đ. Số 22, Thường Thạnh, Cái Răng, Cần Thơ",
                "client_order_code" => "",
                "to_name" => "Tên khách hàng",
                "to_phone" => "0987654321",
                "to_address" => "72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam",
                "to_ward_name" => "Phường 14",
                "to_district_name" => "Quận 10",
                "to_province_name" => "HCM",
                "cod_amount" => 20000000,
                "content" => "Cảm ơn quý khách đã mua hàng",
                "weight" => 200,
                "length" => 20,
                "width" => 8,
                "height" => 10,
                "cod_failed_amount" => 20000,
                "pick_station_id" => 1444,
                "deliver_station_id" => null,
                "insurance_value" => 10000,
                "service_id" => 0,
                "service_type_id" => 2,
                "coupon" => null,
                "pickup_time" => time(),
                "pick_shift" => [2],
                "items" => $products
            ]
        );

        return response()->json(['response' => $response['data']]);
    }
}
