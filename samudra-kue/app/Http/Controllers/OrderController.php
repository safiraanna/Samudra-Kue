<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;

class OrderController extends Controller {

    public function show() {
        $orders = Order::where('userID', auth()->id())->get();

        $shippingAddresses = ShippingAddress::whereIn('id', $orders->pluck('shipping_address_id'))->get();

        return view('user.orders.index', [
            'active' => 'orders',
            'title' => "Pesanan",
            "orders" => $orders,
            "shippingAddresses" => $shippingAddresses,
        ]);
    }

    public function showOrderDetails($orderID) {
        $order = Order::with('orderItems.product')->find($orderID);
    
        return view('user.orders.details', ['order' => $order]);
    }
}