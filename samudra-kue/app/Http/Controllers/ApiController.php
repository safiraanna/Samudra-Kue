<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ApiController extends Controller 
{
    public function payment_handler(Request $request) {
        //ubah data ke bentuk JSON
        $json = json_decode($request->getContent());

        //generate signature key
        $signature_key = hash('sha512', $json->order_id  . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY'));

        //jika siganture berbeda, tolak saja
        if ($signature_key != $json->signature_key) {
            return abort(404);
        }

        //status berhasil
        $order = Order::where('id', $json->order_id,)->first();

        //return dengan update data order
        // return $order->update(['payment_status' => $json->transaction_status]);
        if ($order) {
            // Update data order
            $order->update([
                'payment_status' => $json->transaction_status,
                'payment_method' => $json->payment_type,
                'pdf_url' => isset($json->pdf_url) ? $json->pdf_url : null,
                'transaction_id' => isset($json->transaction_id) ? $json->transaction_id : null,
            ]);
    
            // Return sesuatu, misalnya response HTTP OK
            return response()->json(['message' => 'Order berhasil diupdate'], 200);
        } else {
            // Return jika order tidak ditemukan
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }
    }
}