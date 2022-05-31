<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetails')->get();
        $products = Product::get(['id','name','image']);

        return view('orders.index', compact('orders','products'));
    }

    public function show(Order $order)
    {
        return view('Orders.show', compact('order'));
    }

    public function changeStatus(Order $order)
    {
        $order->is_delivered = !$order->is_delivered;
        
        $order->update();

        return redirect()->route('orders.index')->with('status','Order Delivery status has been changed successfully !');
    } 
}
