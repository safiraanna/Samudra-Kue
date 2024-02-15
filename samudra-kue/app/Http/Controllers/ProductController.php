<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller  {
    public function home(Request $request) {
        // Filter pencarian
        $products = Product::filter($request->only('search'));
    
        // Paginasi
        $products = $products->paginate(12);
    
        return view('home', [
            'products' => $products,
            'isEmptySearch' => $products->total() === 0,
        ]);
    }

    public function show(Product $product) { 
    
        return view('products.product', compact('product'));
    }
}