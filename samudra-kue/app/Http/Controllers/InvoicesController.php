<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OrderItem;
use App\Models\Order;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoicesController extends Controller {
    public function generateInvoices(Request $request, $orderId) {
        $order = Order::findOrFail($orderId);
        $invoiceDate = $order->updated_at;

        $customer = new Buyer([
            'name' => $order->user->username,
            'custom_fields' => [
                'phone_number' => $order->user->phone_number,
            ],
        ]);

        $invoiceItems = [];
        foreach ($order->orderItems as $orderItem) {
            $product = $orderItem->product;

            // Create an invoice item for each product in the order
            $item = InvoiceItem::make($product->product_name)
                ->pricePerUnit($product->price_unit)
                ->quantity($orderItem->qty);

            $invoiceItems[] = $item;
        }

        // Create the invoice
        $invoice = Invoice::make()
            ->date($invoiceDate) // Mengatur tanggal invoice
            ->buyer($customer)
            ->addItems($invoiceItems) // Add all invoice items
            // ->discountByPercent($order->discount_percent)
            // ->taxRate($order->tax_rate)
            ->shipping($order->shipping_cost);

        // Return the invoice as a stream (to view or download)
        return $invoice->stream();
    }
}
