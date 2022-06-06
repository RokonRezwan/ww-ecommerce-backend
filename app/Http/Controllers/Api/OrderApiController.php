<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class OrderApiController extends Controller
{
    private $_getColumns = (['id', 'category_id', 'name', 'slug', 'image', 'description', 'is_active']);

    public function index()
    {
        $orders = Order::with('orderDetails')->get($this->_getColumns);
        $products = Product::get(['id','name','image']);
        
        return response()->json([
            'orders' => $orders,
            'products' => $products
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use($request)
            {
                $shipping = $request->shippingUserName.'<br>'.$request->shipping_address;
                $billing = $request->billingUserName.'<br>'.$request->billing_address;

                $order = new Order;

                $order->user_id = 1;
                $order->order_status_id = 1;
                $order->order_number = random_int(100000,999999);
                $order->shipping_address = $shipping;
                $order->billing_address = $billing;
                $order->promo_discount_amount = $request->promo_discount_amount;
                $order->tax_amount = $request->tax_amount;
                $order->shipping_fee = $request->shipping_fee;
                $order->item_sub_total = $request->item_sub_total;
                $order->grand_total = $request->grand_total;
                $order->payment_method = $request->payment_method;

                $order->save();

                $getAllPrices = $request->prices;
                $product_names = $request->product_name;
                $quantities = $request->quantity;

                $cartItems = [];

                if(($getAllPrices !== NULL) && ($product_names !== NULL)){
                    foreach ($getAllPrices as $index => $price) {
                        $cartItems[] = [
                            'order_id' => $order->id,
                            'product_name' => $product_names[$index],
                            'price' => $price,
                            'quantity' => $quantities[$index],
                        ];
                    }
                }

                if ( ($price !== NULL) && ($product_names[$index] !== NULL) ){
                    $orderDetails = new OrderDetails;
                    $orderDetails->insert($cartItems);
                }
            });

        } catch (QueryException $e) {

            return back()->withErrors(['status' => $e->getMessage()]);
        }

        return response()->json(['status' => 'Order Placed Successfully']);
    }
}
