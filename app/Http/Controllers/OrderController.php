<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $_getColumns = ['id','order_number','shipping_address','billing_address','grand_total','order_status_id','created_at'];
    
    public function index()
    {
        $orders = Order::OrderByIdDescending()->get($this->_getColumns);
        $orderStatus = OrderStatus::get(['id','name']);

        return view('orders.index', compact('orders','orderStatus'));
    }

    public function show(Order $order)
    {
        $order = Order::with('orderDetails')->find($order->id);
        return view('Orders.show', compact('order'));
    }
    
    public function changeDeliveryStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->order_status_id = $request->order_status_id;
        $order->save();
        return response()->json(['success' => 'Price Type Active Status Change Successfully.']);
    }


}
