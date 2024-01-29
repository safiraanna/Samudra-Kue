<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller {
    public function addToCart(Request $request, $id) {
        $product = Product::find($id);

        if(!$product) {
            return redirect()->route('home')->with('error', 'Produk tidak ditemukan');
        }

        $quantity = $request->input('quantity', 1);
        $price_subtotal = $this->calculateSubtotal($product, $quantity);

        CartItem::create([
            'userID' => auth()->id(),
            'productID' => $product->id,
            'qty' => $quantity,
            'price_subtotal' => $price_subtotal,
            'attributes' => [],
        ]);

        return redirect()->route('home')->with('success', 'Produk berhasil ditambahkan');
    }

    private function calculateSubtotal(Product $product, $quantity) {
        $unit_per_box = $product->unit_per_box;
    
        if ($quantity > $unit_per_box) {
            // Jika jumlah beli lebih besar dari jumlah satuan per dus, gunakan harga dus
            return $quantity * $product->price_box_unit;
        } else {
            // Jika tidak, gunakan harga satuan
            return $quantity * $product->price_unit;
        }
    }    

    public function show() {
        $cartItems = CartItem::where('userID', auth()->id())->get();

        $total = CartItem::where('userID', auth()->id())
        ->where('chosen', true)
        ->sum('price_subtotal');

        return view('carts.index', [
            'active' => 'carts',
            'title' => "Keranjang",
            "cartItems" => $cartItems,
            'total' => $total,
        ]);
    }

    public function processCheckout(Request $request) {
        $chosenProducts = $request->input('chosen');
    
        // Pemeriksaan jika array $chosenProducts kosong
        if (empty($chosenProducts)) {
            Alert::error('Maaf', 'Anda belum memilih produk apapun');
            return redirect()->back()->with('error', 'Anda belum memilih produk apapun untuk checkout.');
        }
    
        // if (!$this->userHasAddress()) {
        //     return redirect()->route('addresses.index')->with('error', 'Tambahkan alamat terlebih dahulu.');
        // }
    
        // Pembaruan chosen hanya jika ada produk yang dipilih
        CartItem::whereIn('productID', $chosenProducts)
            ->update(['chosen' => 1]);
    
        // Redirect ke halaman checkout
        return redirect()->route('checkout.show');
    }

    public function showCheckout() {
        // Ambil alamat pengiriman dari database
        $shippingAddress = ShippingAddress::where('userID', auth()->id())->first();
    
        // Ambil daftar produk dalam keranjang
        $cartItems = CartItem::where('userID', auth()->id())->get();
    
        // Hitung total pesanan
        $total = 0;
        foreach ($cartItems as $cartItem) {
            if ($cartItem->chosen == 1) {
                $total += $cartItem->price_subtotal;
            }
        }
        
        $shippingCost = $this->calculateShippingCost($shippingAddress->kecamatan);

        // Tampilkan halaman checkout dengan produk yang dipilih, alamat pengiriman, dan total pesanan
        return view('orders.checkout', [
            'shippingAddress' => $shippingAddress, 
            'total' => $total, 
            'cartItems' => $cartItems,
            'shippingCost' => $shippingCost, // Menambahkan biaya pengiriman ke view
        ]);
    }
    
        private function userHasAddress() {
        $shippingAddress = ShippingAddress::where('userID', auth()->id())->first();
        return $shippingAddress ? true : false;
    }
    
    private function calculateShippingCost($kecamatan) {
        switch ($kecamatan) {
            case 'Banjar':
                return 2000;
            case 'Purwaharja':
                return 4000;
            case 'Pataruman':
                return 7000;
            case 'Langensari':
                return 9000;
            default:
                return 0;
        }
    }

    public function storeCheckout(Request $request) {
        Log::info('Metode storeCheckout dijalankan.');

        $request->validate([
            'address' => 'required|exists:shipping_addresses,id',
            // 'order_date' => 'required|date',
            'shipping_cost' => 'required',
            'payment_total' => 'required|numeric',
            'payment_method' => 'required',
            'add_notes' => 'nullable',
            'chosenProducts' => 'required|array',
        ]);
    
        // Ambil data alamat pengiriman
        $addressId = $request->input('address');
        $address = ShippingAddress::find($addressId);
    
        // Buat entri baru di tabel `order`
        $order = new Order();
        $order->userID = auth()->user()->id;
        $order->addressID = $address->id;
        // $order->order_date = $request->input('order_date');
        $order->shipping_cost = $request->input('shipping_cost');
        $order->payment_total = $request->input('payment_total');
        $order->payment_method = $request->input('payment_method');
        $order->payment_status = 'Belum Dibayar';
        $order->order_status = 'Pesanan diterima oleh toko';
        $order->add_notes = $request->input('add_notes');
        $order->save();
    
        $chosenProductIds = $request->input('chosenProducts');

        DB::transaction(function () use ($order, $chosenProductIds) {
            // Simpan Order
            $order->save();
    
            foreach ($chosenProductIds as $productId) {
                // Cari instance CartItem yang sesuai dengan ID produk
                $cartItem = CartItem::where('userID', auth()->id())
                    ->where('productID', $productId)
                    ->where('chosen', 1)
                    ->first();
    
                if ($cartItem) {
                    // Pastikan stok cukup untuk pesanan
                    $product = Product::find($cartItem->productID);
                    if ($cartItem->qty > $product->stocks) {
                        // Handle kasus di mana stok tidak mencukupi
                        // Misalnya, tambahkan pesan kesalahan dan arahkan kembali ke halaman sebelumnya
                        return redirect()->back()->with('alert-error', 'Stok barang tidak mencukupi.');
                    }

                    // Buat dan simpan entri baru di tabel `order_item` untuk setiap produk yang dipilih
                    $orderItem = new OrderItem();
                    $orderItem->orderID = $order->id;
                    $orderItem->productID = $cartItem->productID;
                    $orderItem->price = $cartItem->price_subtotal;
                    $orderItem->qty = $cartItem->qty;
                    $orderItem->save();

                    // Update stok produk
                    $product = Product::find($cartItem->productID);
                    $product->stocks -=$cartItem->qty;
                    $product->save();

                    $cartItem->delete();
                }
            }
        });
    
        return redirect()->route('orders')->with('success', 'Pesanan Anda telah berhasil dibuat');
    }
}