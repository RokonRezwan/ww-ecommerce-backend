@extends('layouts.app')

@section('title', 'All Orders')

@section('content')

    <div class="row justify-content-center mb-2">
        <div class="col-md-12">

            <div class="row justify-content-center g-0">
                <div class="col-12 text-end">
                    <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Orders List</h3>
                </div>
                <div class="card-body">

                    @if (session('status'))
                        <div class="row">
                            <div class="col-12 alert alert-success text-center" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order Number</th>
                                    <th class="text-center no-sort">Customer Name</th>
                                    <th class="text-center no-sort">Shipping Address</th>
                                    <th class="text-center no-sort">Phone Number</th>
                                    <th class="text-center no-sort">Total Price</th>
                                    <th class="text-center no-sort">Delivery Status</th>
                                    <th class="text-center no-sort">Delivery Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl =1;
                                @endphp
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td class="text-center">
                                            {{ $order->customer_name }}
                                        </td>
                                        <td>
                                          {{ $order->shipping_address }}
                                        </td>
                                        <td class="text-center">
                                          {{ $order->phone_number }}
                                        </td>
                                        <td class="text-center">
                                          {{ $order->total_price }}
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('orders.changeStatus', $order->id) }}" method="post">
                                            @csrf
                                            @method('GET')

                                                @if ($order['is_delivered'] == 1)
                                                    <button type="submit" class="btn btn-success">Delivered</button>
                                                @else
                                                    <button type="submit" class="btn btn-danger">Not Delivered</button>
                                                @endif
                                            </form>
                                        </td>
                                        <td class="text-center">
                                          <div class="btn-group" role="group">
                                               <a href="{{ route('orders.show', $order->id) }}" 
                                                  class="btn btn-primary me-1"><i class="fa fa-eye"></i></a>
                                          </div>
                                      </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable({
                order: [0,'desc'],
                responsive: true,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }],
            });
        });
    </script>
@endpush
