@extends('admin.layout.maste-admin')
@section('title')
    Category Admin
@endsection
@section('container')
    @can('Browse category', Auth::user())
        <div class="content-row">
            <div class="col-md-12 tabbable tabs-right">
                <h1 id="tables" class="page-header">Category
                </h1>
                <div class="col-md-9">
                    <form action="{{ route('admin.categories.search') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search for...">
                            <span class="input-group-btn ">
                                <button class="btn btn-default " type="submit">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.categories.create') }}" class="btn-lg btn-primary mt-3">Create Category</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Category Slug</th>
                                <th rowspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row content-row-pagination">
            <div class="col-md-12">
                <ul class="pagination">
                    @if ($current_page <= 1)
                        <li class="disable"><a href="#">PREV</a></li>
                        @for ($i = 1; $i <= $total_pages; $i++)
                            <li class="">
                                <a href="{{ $path }}?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="active"><a href="{{ $path }}?page={{ $current_page + 1 }}">NEXT</a></li>
                    @else
                        <li class="active"><a href="{{ $path }}?page={{ $current_page - 1 }}">PREV</a></li>
                        @for ($i = 1; $i <= $total_pages; $i++)
                            <li class="">
                                <a href="{{ $path }}?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="active"><a href="{{ $path }}?page={{ $current_page + 1 }}">NEXT</a></li>
                    @endif
                </ul>
            </div>
        </div>
    @endcan
    @cannot('Browse category', Auth::user())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> You don't have permission to create category.
        </div>
    @endcannot
@endsection
