<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller 
{
    public function home(Request $request) {
        $title = ' ';
    
        $products = Product::filter($request->only('search'))
            ->simplePaginate(12);
    
        if(!$request->has('search')) {
            $products = Product::simplePaginate(12);
        }
    
        return view('home', [
            'active' => 'products',
            'title' => "Samudra Kue" . $title,
            'products' => $products,
        ]);
    }
    
    public function show(Product $product) { 
    
        return view('products.product', [
            'active' => 'products',
            'title' => "Single Product",
            'product' => $product
        ]);
    }
}