@extends('layouts.app')

@section('title', 'All Products')

@section('content')

{{-- {{ dd($products); }} --}}

    <div class="row justify-content-center mb-2">
        <div class="col-md-12">

            <div class="row justify-content-center g-0">
                <div class="col-12 text-end">
                    <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
                    <a class="btn btn-primary" href="{{ route('products.create') }}">Add Product</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Products List</h3>
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
                                    <th>Name</th>
                                    <th class="text-center no-sort">Category</th>
                                    <th class="text-center no-sort">Image</th>
                                    <th class="text-center no-sort">Prices</th>
                                    <th class="text-center no-sort">Status</th>
                                    <th class="text-center no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl =1;
                                @endphp
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td class="text-center">
                                            {{ $product->category->name }}
                                        </td>
                                        <td>
                                            @if ($product->image)
                                            <img src="{{ asset('product-images/' . $product->image) }}"
                                            height="25" width="40">                                                
                                            @else
                                                <small>No Image</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @foreach ($product->prices as $price)
                                            <div>{{ $price->priceTypes->name }} : <strong>৳ {{ $price->amount }}</strong></div> 
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('products.changeStatus', $product->id) }}" method="post">
                                            @csrf
                                            @method('GET')

                                                @if ($product['is_active'] == 1)
                                                    <button type="submit" class="btn btn-success">Active</button>
                                                @else
                                                    <button type="submit" class="btn btn-danger">Inactive</button>
                                                @endif

                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                 <a href="{{ route('products.show', $product->id) }}" 
                                                    class="btn btn-primary me-1"><i class="fa fa-eye"></i></a>

                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-info me-1"><i class="fa fa-edit"></i></a>

                                                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this product ?')"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
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
