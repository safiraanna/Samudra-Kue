<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
    public function processPayment(Request $request, $orderID) {
        $order = Order::find($orderID);

        if (!$order) {
            // Handle jika pesanan tidak ditemukan
            return redirect()->route('home')->with('alert-error', 'Pesanan tidak ditemukan.');
        }

        // Lakukan validasi pembayaran di sini jika diperlukan

        // Membuat pembayaran dengan Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $total_price = $order->payment_total + $order->shipping_cost;

        $payload = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $total_price,
            ],
            'credit_card' => [
                'secure' => true,
            ],
        ];

        $snapToken = Snap::getSnapToken($payload);

        // Redirect ke halaman pembayaran Midtrans
        return view('user.orders.payment', [
            'snapToken' => $snapToken,
            'order' => $order,
        ]);
    }

    public function updateOrder(Request $request) {
        $json = json_decode($request->get('json_callback'));
        
        if ($json && isset($json->status_code)) {
            $orderID = $request->input('order_id');
            $order = Order::find($orderID);

            if ($order) {
                if($json->status_code == '200') {
                    $order->update([
                        'payment_status' => $json->transaction_status,
                        'payment_method' => $json->payment_type,
                        'pdf_url' => isset($json->pdf_url) ? $json->pdf_url : null,
                        'transaction_id' => isset($json->transaction_id) ? $json->transaction_id : null,
                        'snap_token' => $json->payment_code
                    ]);
                    return redirect()->route('home')->with('alert-success', 'Pembayaran berhasil!');
                } else {
                    return redirect()->route('home')->with('alert-error', 'Status transaksi tidak valid.');
                }
            } else {
                return redirect()->route('home')->with('alert-error', 'Pesanan tidak ditemukan.');
            }
        } else {
            return redirect()->route('home')->with('alert-error', 'Data notifikasi tidak valid.');
        }
    }
}
