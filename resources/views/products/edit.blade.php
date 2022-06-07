@extends('layouts.app')

@section('title', 'Update Product')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 w-75">

            <div class="row justify-content-center g-0">
                <div class="col-12 text-end">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>

            <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="card">

                    <div class="card-header">
                        <h3>Update Product</h3>
                    </div>

                    <div class="card-body" >

                        @if ($errors->any())
                            <div class="row">
                                <div class="col-12 alert alert-danger p-1 m-0">
                                    <ul class="g-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="row p-2">
                            <label for="name" class="col-md-2 col-form-label">Name <b class="text-danger">*</b></label>
                            <div class="col-md-10">
                                <input type="text" id="name" class="form-control" value="{{ $product->name }}"
                                    name="name" placeholder="Enter Product name" required autofocus>
                            </div>
                        </div>

                        <div class="row p-2">
                            <label for="category" class="col-md-2 col-form-label">Category</label>
                            <div class="col-md-10">
                                
                                <select class="form-control" name="category_id">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $product->category_id) selected @endif>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row p-2">
                            <label for="image" class="col-md-2 col-form-label">Image</label>
                            <div class="col-md-8">
                                <input type="file" id="image" class="form-control" value="{{ old('image') }}"
                                    name="image" accept="image/*">                                
                            </div>
                            <div class="col-md-2">
                                @if ($product->image)
                                <img src="{{ asset('product-images/' . $product->image) }}"
                                height="50" width="75">                                                
                            @else
                                <small>No Image</small>
                            @endif
                            </div>
                        </div>
                        
                        

                        <div class="row prices p-2">
                            <label for="price" class="col-md-2 col-form-label">Price</label>
                            <div class="col-md-10">

                                <div class="row d-flex align-items-end">
                                    <div class="col-md-2 col-12">
                                        <label for="price_type_id" class="form-label">Price Type</label>
                                    </div>
        
                                    <div class="col-md-2 col-12">
                                        <label for="price" class="form-label">Price</label>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <label for="price" class="form-label">Start Date</label>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <label for="price" class="form-label">End Date</label>
                                    </div>
        
                                    <div class="col-md-2 col-12">
                                        <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus"
                                                aria-hidden="true"></span> Add More</a>
                                    </div>
                                </div>

                                @forelse ($product->prices as $price)
                                    <input type="hidden" value="{{ $price->id }}" name="product_price_id[]"/>

                                    <div class="row col-md-10" style="margin-bottom: 5px">
                                        <div class="col-md-2 col-12 g-0" style="padding-right:5px!important">
                                            <select class="form-select" name="price_type_id[]" id="price_type_id">
                                            <option value="" selected>Select Price Type</option>                                                
                                                @foreach ($priceTypes as $ptype)
                                                <option value="{{ $ptype->id }}" @if ($ptype->id == $price->priceTypes->id) selected @endif>{{ $ptype->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <div class="col-md-2 col-12" style="padding-right:5px!important">
                                            <input type="number" min="0" class="form-control" name="amount[]" id="amount" placeholder="Price"
                                                    value="{{ $price->amount }}">
                                        </div>

                                        <div class="col-12 col-md-3 g-0" style="padding-right:5px!important">
                                            <input type="date" class="form-control" name="start_date[]" value="{{ $price->start_date }}"
                                                id="start_date">
                                        </div>
        
                                        <div class="col-12 col-md-3 g-0" style="padding-right:5px!important">
                                            <input type="date" class="form-control" name="end_date[]" value="{{ $price->end_date }}"
                                                id="end_date">
                                        </div>
        
                                        <div class="col-md-2 col-12 d-flex align-items-end g-0" style="margin-top:5px!important;">
                                            <a href="javascript:void(0)" class="btn btn-danger deleteRecord" data-id="{{ $price->id }}"><span class="glyphicon glyphicon glyphicon-remove"
                                                    aria-hidden="true"></span> Remove</a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row col-md-10 g-0" style="padding:0px;">
                                        <div class="col-md-2 col-12 g-0" style="padding:0px;">
                                            <select class="form-select" name="price_type_new_id[]" id="price_type_new_id">
                                                <option value="" selected>Select Price Type</option>
                                                @foreach ($priceTypes as $ptype)
                                                <option value="{{ $ptype->id }}">{{ $ptype->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <div class="col-md-3 col-12 g-0" style="padding-right:5px!important">
                                            <input type="number" min="0" class="form-control" name="new_amount[]" id="new_amount" placeholder="Price"
                                                    value="{{ old('new_amount[]') }}">
                                        </div>

                                        <div class="col-12 col-md-3 g-0" style="padding-right:5px!important">
                                            <input type="date" class="form-control" name="new_start_date[]" value="{{ date('Y-m-d') }}"
                                                id="new_start_date">
                                        </div>
        
                                        <div class="col-12 col-md-3 g-0" style="padding-right:5px!important">
                                            <input type="date" class="form-control" name="new_end_date[]" value="{{ date('Y-m-d') }}"
                                                id="new_end_date">
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="row p-2">
                            <label for="description" class="col-md-2 col-form-label">Description</label>
                            <div class="col-md-10">
                                <textarea type="text" id="description" class="form-control" name="description"
                                    placeholder="Enter Product Details">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        <div class="card-footer float-end">
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </div>
                    </div>
                </div> <!-- /.card -->
            </form>
        </div>
    </div>

        <!-- For Add New Input Row -->
        <div class="row pricesCopy p-2" style="display: none;">
            <label for="price" class="col-md-2 col-form-label"></label>
            <div class="row col-md-10">
                <div class="col-md-2 col-12 g-0" style="padding-right:5px!important">
                    <select class="form-select" name="price_type_new_id[]" id="price_type_new_id">
                        <option value="" selected>Select Price Type</option>
                        @foreach ($priceTypes as $ptype)
                        <option value="{{ $ptype->id }}">{{ $ptype->name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-12 col-md-2 g-0" style="padding-right:5px!important">
                    <input type="number" min="0" class="form-control" name="new_amount[]" id="new_amount" placeholder="Price"
                            value="{{ old('new_amount[]') }}">
                </div>

                <div class="col-12 col-md-3 g-0" style="padding-right:5px!important">
                    <input type="date" class="form-control" name="new_start_date[]" value="{{ date('Y-m-d') }}"
                        id="new_start_date">
                </div>

                <div class="col-12 col-md-3 g-0" style="padding-right:5px!important">
                    <input type="date" class="form-control" name="new_end_date[]" value="{{ date('Y-m-d') }}"
                        id="new_end_date">
                </div>
    
                <div class="col-md-2 col-12 d-flex align-items-end g-0">
                    <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove"
                            aria-hidden="true"></span> Remove</a>
                </div>
    
            </div>
        </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // Upload Image Preview
        $(document).ready(function (e) {
            //add more fields group
            $(".addMore").click(function(){
                    var fieldHTML='<div class="row prices p-3" style="margin-top:5px!important">'
                    +$(".pricesCopy").html()+'</div>';
                    $('body').find('.prices:last').after(fieldHTML);
                });
            //remove fields group
            $("body").on("click",".remove",function(){
                    $(this).parents(".prices").remove();
                });
        });

        // Delete Price List Data
        $('.deleteRecord').click(function() {
            var price_id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                type: "POST",
                dataType: "json",
                cache: false,
                url: "{{ url('products/product/price-list') }}/"+price_id,
                data: {'price_id': price_id , '_token': token,},
                beforeSend:function(){
                    return confirm("Are you sure want to delete this price ?");
                },
                success: function(data){
                    $(".del_row" + price_id).remove();
                    $("#successMessage").html(data.success).show().delay(3000).fadeOut(400);
                }
            });
        })

    </script>
@endpush