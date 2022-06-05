<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderApiController extends Controller
{
    /* private $_getColumns = (['id', 'category_id', 'name', 'slug', 'image', 'description', 'is_active']); */

    public function index()
    {
        $orders = Order::with('orderDetails')->get();
        $products = Product::get(['id','name','image']);
        
        return response()->json([
            'orders' => $orders,
            'products' => $products
        ], 200);
    }

    public function store(Request $request)
    {
        return $request;
        $order = new Order;
        $order->order_number = random_int(000001,999999);
        $order->total_price = $request->total_price;
        /* $order->customer_name = $request->customer_name; */

        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
