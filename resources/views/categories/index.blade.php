@extends('layouts.app')

@section('title', 'All Categories')

@section('content')

    <div class="row justify-content-center mb-2">
        <div class="col-md-12">

            <div class="row justify-content-center g-0">
                <div class="col-12 text-end">
                    <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
                    <a class="btn btn-primary" href="{{ route('categories.create') }}">Add Category</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Categories List</h3>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th class="text-center no-sort">Status</th>
                                    <th class="text-center no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl =1;
                                @endphp
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>
                                            {{ $sl++ }}
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('categories.changeStatus', $category->id) }}" method="post">
                                            @csrf
                                            @method('GET')

                                                @if ($category->is_active == 1)
                                                    <button type="submit" class="btn btn-success">Active</button>
                                                @else
                                                    <button type="submit" class="btn btn-danger">Inactive</button>
                                                @endif

                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                 <a href="{{ route('categories.show', $category->id) }}" 
                                                    class="btn btn-primary me-1"><i class="fa fa-eye"></i></a>

                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="btn btn-info me-1"><i class="fa fa-edit"></i></a>

                                                <form action="{{ route('categories.destroy', $category->id)  }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this Category ?')"><i
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
