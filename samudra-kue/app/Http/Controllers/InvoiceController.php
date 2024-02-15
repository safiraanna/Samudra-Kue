<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller {
    public function generateInvoice(Request $request, $orderId) {
        $user = Auth::user();
        $order = Order::findOrFail($orderId);
        $orderItems = OrderItem::where('orderID', $orderId)->get();

        $html = view('user.orders.invoices', ['order' => $order, 'orderItems' => $orderItems, 'user' => $user]);

        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('a4','landscape');
        $pdf->render();

        return $pdf->stream('Invoice-' . $order->user->username . '-' . $order->id . '.pdf');
    }
}
