@extends('layouts.app')

@section('title', 'Order Details')

@section('content')

<div class="container p-4">
    <div class="row g-0 mb-4 border border-gray">
        <div class="col-md-8 d-flex align-items-center" style="font-size: 18px;">
            <a href="{{ url('/home') }}" class="ms-2 font-weight-bold me-1" style="text-decoration: none">Home </a> > <span
                class="ms-1">Order Summary</span>
        </div>
        <div class="col-md-4 g-0">
            <a href="{{ route('orders.index') }}" class="btn btn-success float-end m-0">Back</a>
        </div>
    </div>

    @php
          $sl= 1;
    @endphp

    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h2>Order Details</h2>
        </div>
        <div class="card-body">
            
            <div class="row">
                  <div class="table-responsive col-md-8">
                        <table class="table table-bordered align-middle text-center">
                              <thead>
                                    <tr>
                                          <th style="width:10%">#</th>
                                          <th style="width:40%">Name</th>
                                          <th style="width:20%">Price</th>
                                          <th style="width:15%">Quantity</th>
                                          <th style="width:15%">Sub Total</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach($order->orderDetails as $details)

                                    <tr>
                                          <td>{{ $sl++ }}</td>
                                          <td>
                                                {{ $details['product_name'] }}
                                          </td>
                                          <td>
                                                {{ $details['price'] }}
                                          </td>
                                          <td data-th="Quantity">
                                                {{ $details['quantity'] }}
                                          </td>
                                          <td data-th="Subtotal" class="text-center">
                                                {{ $details['price'] * $details['quantity'] }}
                                          </td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                          <td colspan="4" class="text-end">
                                                <h5><strong>Item ( {{ count($order->orderDetails) }} ) Sub Total</strong></h5>
                                          </td>
                                          <td>
                                                <h5>
                                                <strong>{{ $order->item_sub_total }}</strong>
                                                </h5>
                                          </td>
                                    </tr>

                                    <tr>
                                          <td colspan="4" class="text-end">
                                                <strong>Shipping Fee</strong>
                                          </td>
                                          <td>
                                                {{ $order->shipping_fee }}
                                          </td>
                                    </tr>

                                    <tr>
                                          <td colspan="4" class="text-end"><strong>Tax</strong></td>
                                          <td>
                                                {{ $order->tax_amount }}
                                          </td>
                                    </tr>

                                    <tr>
                                          <td class="text-end" colspan="4">
                                                Redeem Code: <strong style="color:red">#PROMOCODE</strong>
                                          </td>
                                          <td>
                                                <strong>-{{ $order->promo_discount_amount }}</strong>
                                          </td>
                                    </tr>
                              </tbody>

                              <tfoot>
                                    <tr>
                                    <td colspan="4" class="text-end">
                                          <h3><strong>Grand Total</strong></h3>
                                    </td>
                                    <td>
                                          <h3>
                                          {{ $order->grand_total }}
                                          </h3>
                                    </td>
                                    </tr>
                              </tfoot>
                        </table>
                  </div>
                  <div class="col-md-4">
                        <div class="row">
                              <div class="col-md-12">
                                    <div class="card">
                                          <div class="card-header">
                                                <h5><strong>Shipping Address</strong></h5>
                                          </div>
                                          <div class="card-body">
                                                {!! $order->shipping_address !!}
                                          </div>
                                    </div>
                                    <div class="card">
                                          <div class="card-header">
                                                <h5><strong>Billing Address</strong></h5>
                                          </div>
                                          <div class="card-body">
                                                {!! $order->billing_address !!}
                                          </div>
                                    </div>
                                    <div class="card">
                                          <div class="card-header">
                                                <h5><strong>Payment Method</strong></h5>
                                          </div>
                                          <div class="card-body">
                                                @if ($order->payment_method == 1)
                                                      <span class="badge badge-primary p-3">Cash On Delivery</span>
                                                @else
                                                      <span class="badge badge-primary p-3">Others</span>
                                                @endif
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>

@endsection