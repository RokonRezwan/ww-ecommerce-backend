@extends('layouts.app')

@section('title','Show Product')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12  w-75">

            <div class="row justify-content-center g-0">
                <div class="col-12 text-end">
                    <a href="{{ route('priceTypes.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Show Price Type Details</h3>
                </div>

                <div class="card-body">
                    <div class="row p-1">
                        <div class="col-2">
                            <strong>Name :</strong>
                        </div>
                        <div class="col-10">
                            {{ $priceType->name }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-2">
                            <strong>Status :</strong>
                        </div>
                        <div class="col-10">
                            @if ($priceType->is_active == 1)
                                Active
                            @else
                                Deactive
                            @endif
                        </div>
                    </div>

                </div>
            </div>  <!-- /.card -->
        </div>
    </div>
@endsection
