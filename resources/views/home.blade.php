@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    
                    <div class="row justify-content-center">

                        <div class="col-4">
                            <div class="card bg-primary text-white" style="width: 18rem;">
                                <div class="card-body">
                                  <h5 class="card-title">Product Index</h5>
                                  <p class="card-text">Show all products and CRUD operations.</p>
                                  <a href="{{ route('products.index') }}" class="btn btn-success">Products</a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-4">
                            <div class="card bg-primary text-white" style="width: 18rem;">
                                <div class="card-body">
                                  <h5 class="card-title">Category Index</h5>
                                  <p class="card-text">Show all categories and CRUD operations.</p>
                                  <a href="{{ route('categories.index') }}" class="btn btn-success">Categories</a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-4">
                            <div class="card bg-primary text-white" style="width: 18rem;">
                                <div class="card-body">
                                  <h5 class="card-title">Price Types Index</h5>
                                  <p class="card-text">Show all Price Types and CRUD operations.</p>
                                  <a href="{{ route('priceTypes.index') }}" class="btn btn-success">Price Type</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 py-5">
                            <div class="card bg-primary text-white" style="width: 18rem;">
                                <div class="card-body">
                                  <h5 class="card-title">Orders Index</h5>
                                  <p class="card-text">Show all Orders Details.</p>
                                  <a href="{{ route('orders.index') }}" class="btn btn-success">Orders</a>
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
