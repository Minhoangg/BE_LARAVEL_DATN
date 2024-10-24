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
        // Tạo giao dịch mới từ dữ liệu trong request
        $transaction = $this->createTransaction($request);

        // Tìm mã đơn hàng trong nội dung giao dịch
        $sku_order = $this->extractSkuOrder($request->input('content'));

        if ($sku_order) {
            // Xử lý thanh toán
            $order = $this->processPayment($sku_order, $request);

            if ($order) {
                return response()->json([
                    'transaction' => $transaction,
                    'order' => $order
                ]);
            }

            return response()->json(['message' => 'Không tìm thấy đơn hàng.'], 404);
        }

        return response()->json($transaction);
    }

    private function createTransaction(Request $request)
    {
        return SePayTransaction::create($request->only([
            'gateway',
            'transactionDate',
            'accountNumber',
            'subAccount',
            'code',
            'content',
            'transferType',
            'description',
            'transferAmount',
            'referenceCode'
        ]));
    }

    private function extractSkuOrder($content)
    {
        preg_match('/MDH\w+/', $content, $matches);
        return $matches[0] ?? null;
    }

    private function processPayment($sku_order, Request $request)
    {
        $order = OrderModel::where('sku_order', $sku_order)->first();

        if ($order) {
            $transferAmount = $request->input('transferAmount');
            $totalAmount = $order->total;

            if ($transferAmount > $totalAmount) {
                $order->payment_status_id = 4;
            } elseif ($transferAmount < $totalAmount) {
                $order->payment_status_id = 3;
            } else {
                $order->payment_status_id = 2;
            }

            $order->payment_at = now();
            $order->save();
        }

        return $order;
    }



    public function getbyid(Request $request, $id)
    {


        $transaction = SePayTransaction::find($id);

        return response()->json($transaction);
    }
}
