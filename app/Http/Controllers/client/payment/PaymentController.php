<?php

namespace App\Http\Controllers\client\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use SePay\SePay\Events\SePayWebhookEvent;
use SePay\SePay\Notifications\SePayTopUpSuccessNotification;
use App\Models\SePayTransaction;


class PaymentController extends Controller
{

    public function paymentHandle(Request $request)
    {

        $order = OrderModel::find($request->order_id);

        $total = $order->total;

        $qrcodeImage =  'https://qr.sepay.vn/img?acc=0947702541&bank=MB&amount=' . $total . '&des=Thanh Toán Đơn Hàng';

        return response()->json(['qrcodeImage' => $qrcodeImage]);
    }

    public function paymentHook(Request $request)
    {
        $transaction = SePayTransaction::create([
            'gateway' => $request->input('gateway'),
            'transactionDate' => $request->input('transactionDate'),
            'accountNumber' => $request->input('accountNumber'),
            'subAccount' => $request->input('subAccount'),
            'code' => $request->input('code'),
            'content' => $request->input('content'),
            'transferType' => $request->input('transferType'),
            'description' => $request->input('description'),
            'transferAmount' => $request->input('transferAmount'),
            'referenceCode' => $request->input('referenceCode'),
        ]);

        return response()->json($transaction);
    }

    public function getbyid(Request $request,$id){


        $transaction = SePayTransaction::find($id);

        return response()->json($transaction);

    }
}
