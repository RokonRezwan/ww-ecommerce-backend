<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::with('category','prices')->get();
        
        return response()->json([
            'product' => $products
        ], 200);
    }

    public function show(Product $api_product)
    {
        $product = Product::with('category','prices')->find($api_product->id);
        return response()->json([
            'message' => "Product Showed Successfully!!",
            'product' => $product
        ], 200);
    }
}
