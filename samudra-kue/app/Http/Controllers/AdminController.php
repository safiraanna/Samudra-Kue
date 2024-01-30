<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function dashboard() {
        $orders =Order::all();
        $users = User::all();
        
        $latestOrders = Order::latest()->take(10)->get();

        $benefit = $orders->sum('payment_total');
        
        $soldoutProducts = Product::where('stocks', 0)->get();

        return view('admin.index', compact('orders','users', 'benefit', 'latestOrders', 'soldoutProducts'));
    }

    public function showOrder(Request $request) {
        $pesanan = Order::with('user')->whereIn ('order_status', [
            'Pesanan diterima oleh toko',
            'Pesanan sedang dikemas',
            'Pesanan dalam pengantaran ke tujuan'
        ])->get();

        return view('admin.order.order', compact('pesanan'));
    }

    public function showFinishedOrder(Request $request) {
        $pesanan = Order::with('user')->where('order_status', 'Pesanan Selesai')->get();

        return view('admin.order.finishedOrder', compact('pesanan'));
    }

    public function showUsers(Request $request) {
        $pengguna = User::all();

        return view('admin.user.users', compact('pengguna'));
    }

    public function updateOrderStatus(Request $request, Order $order) {
        $validatedData = $request->validate([
            'order_status' => 'required',
        ]);

        $order->update([
            'order_status' => $validatedData['order_status'],
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function showOrderDetails(Order $order) {
        $order = Order::with(['user', 'address'])->findOrFail($order->id);

        $orderItems = OrderItem::where('orderID', $order->id)->with('product')->get();
        
        return view('admin.order.detailsOrder', ['order' => $order, 'orderItems' => $orderItems]);
    }

    public function showProducts(Request $request) {
        $searchTerm = $request->input('search');
        $query = Product::query();
        
        if ($searchTerm) {
            $query->where('product_name', 'LIKE', "%{$searchTerm}%");
        }
        
        $products = $query->paginate(5);

        return view('admin.product.index', compact('products'));
    }

    public function destroyProducts(Product $product) {
        $productImages = ProductImage::where('productID', $product->id)->get();

        foreach ($productImages as $image) {
            $imagePath = public_path('storage/product_images/' . $image->picture_name);
    
            // Hapus gambar dari folder
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        ProductImage::where('productID', $product->id)->delete();

        if($product->delete()) {
            return redirect()->route('all.products')->with('success','Produk telah dihapus');
        }

        return redirect()->route('all.products')->with('error','Produk tidak ditemukan');
    }

    public function createProducts() {
        return view('admin.product.create');
    }

    public function storeProducts(Request $request) {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'price_unit' => 'required',
            'price_box_unit' => 'required',
            'unit_per_box' => 'required',
            'stocks' => 'required',
            'description' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $product = new Product;
        $product->product_name = $validatedData['product_name'];
        $product->price_unit = $validatedData['price_unit'];
        $product->price_box_unit = $validatedData['price_box_unit'];
        $product->unit_per_box = $validatedData['unit_per_box'];
        $product->stocks = $validatedData['stocks'];
        $product->description = $validatedData['description'];
        $product->save();

        if ($request->hasFile('images')) {
            $gambar = $request->file('images');

            // Menentukan folder dan nama file
            $folder = 'pictures/product_images'; // Subfolder di dalam folder public
            $filename = $gambar->getClientOriginalName(); // Menggunakan nama file asli

            // Menyimpan gambar di dalam folder public/pictures/product_images
            $gambar->move(public_path($folder), $filename);
            $gambarPath = $filename;
        
            // Simpan nama file gambar ke kolom picture_names
            $productImage = new ProductImage;
            $productImage->productID = $product->id; // Menghubungkan gambar dengan produk
            $productImage->picture_name = $gambarPath;
            $productImage->save();
        }

        return redirect()->route('all.products')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProducts(Product $product) {
        return view('admin.product.edit', compact('product'));
    }

    public function updateProducts(Request $request, Product $product) {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price_unit' => 'required',
            'price_box_unit' => 'required',
            'unit_per_box' => 'required',
            'stocks'=> 'required',
            'description'=> 'required'
        ]);

        $product->update([
            'product_name' => $request->product_name,
            'price_unit'=> $request->price_unit,
            'price_box_unit'=> $request->price_box_unit,
            'unit_per_box'=> $request->unit_per_box,
            'stocks'=> $request->stocks,
            'description'=> $request->description,
        ]);

        return redirect()->route('all.products')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function weeklySalesReport() {
    
        $weeklySales = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('WEEK(created_at) as week'),
            DB::raw('SUM(payment_total) as total_sales')
        )
        ->groupBy('year', 'month', 'week')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->orderBy('week', 'desc')
        ->get();
    
        // Mengambil daftar produk terjual per minggu
        $bestProducts = OrderItem::select(
                'productID',
                DB::raw('SUM(qty) as total_sold')
            )
            ->join('orders', 'order_items.orderID', '=', 'orders.id')
            ->whereBetween('orders.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('productID')
            ->orderByDesc('total_sold')
            ->take(10) // Ambil 10 produk teratas
            ->get();
    
        return view('admin.report.report', compact('weeklySales', 'bestProducts'));
    }

    public function weeklySalesDetails($year, $month, $week) {
        $startDate = Carbon::parse("{$year}-{$month}-{$week}")->startOfWeek();
        $endDate = Carbon::parse("{$year}-{$month}-{$week}")->endOfWeek();
    
        // Ambil data detail laporan per minggu
        $weeklyDetails = OrderItem::select(
                'products.product_name',
                'order_items.qty',
                'order_items.price',
                'orders.id as orderID',
                'orders.userID'
            )
            ->join('orders', 'order_items.orderID', '=', 'orders.id')
            ->join('products', 'order_items.productID', '=', 'products.id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->get();
    
        return view('admin.report.details', compact('weeklyDetails', 'startDate', 'endDate'));
    }
    
}
