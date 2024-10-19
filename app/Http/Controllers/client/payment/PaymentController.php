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

        $skuOder = $order->sku_order;

        $qrcodeImage =  'https://qr.sepay.vn/img?acc=0947702541&bank=MB&amount=' . $total . '&des=' . $skuOder;

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

        $content = $request->input('content');
        preg_match('/MDH\w+/', $content, $matches);

        if (!empty($matches)) {
            $sku_order = $matches[0];
            $order = OrderModel::where('sku_order', $sku_order)->first();

            if ($order) {
                $order->paymend_status_id = 2;
                $order->payment_at = now();
                $order->save();

                return response()->json(['message' => 'Payment status updated successfully.', 'transaction' => $transaction, 'order' => $order]);
            } else {
                return response()->json(['message' => 'Order not found.'], 404);
            }
        }

        return response()->json($transaction);
    }

    public function getbyid(Request $request, $id)
    {


        $transaction = SePayTransaction::find($id);

        return response()->json($transaction);
    }
}
