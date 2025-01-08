@extends('admin.layout.maste-admin')
@section('title')
    Show Category Admin
@endsection
@section('container')
    @can('Movie Has Category', Auth::user())
    <div class="content-row">
        <div class="col-md-12 tabbable tabs-right">
            <h1 id="tables" class="page-header">Category
            <div class="nav nav-tabs" style="padding-bottom:18px;background-color:white">
                <a href="{{ route('admin.categories.add', $id) }}" class="btn-lg btn-primary mt-3">Add Category</a>
            </div>
        </h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Movie Name</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category_movie as $item)
                            <tr>
                                <td>{{ $item->movie->name }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                    <form action="{{ route('admin.categories.delete.post', [$item->category->id, $item->movie->id]) }}" method="POST">
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
    @cannot('Movie Has Category', Auth::user())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> You don't have permission to add category to movie.
        </div>
    @endcannot
@endsection
