@extends('admin.layout.maste-admin')
@section('title')
    Directors Admin
@endsection
@section('container')
    @can('Movie Has Director', Auth::user())
        <div class="content-row">
            <div class="col-md-12 tabbable tabs-right">
                <h1 id="tables" class="page-header">Directors
                    <div class="nav nav-tabs" style="padding-bottom:18px;background-color:white">
                        <a href="{{ route('admin.directors.add', $movie_id) }}" class="btn-lg btn-primary mt-3">Add Directors</a>
                    </div>
                </h1>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Movie Name</th>
                                <th>Director Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($directorMovies as $directorMovie)
                                <tr>
                                    <td>{{ $directorMovie->movie->name }}</td>
                                    <td>{{ $directorMovie->director->name }}</td>
                                    <td>
                                        <form
                                            action="{{ route('admin.directors.delete.post', [$directorMovie->director->id, $movie_id]) }}"
                                            method="POST">
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
    @cannot('Movie Has Director', Auth::user())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> You don't have permission to add director to movie.
        </div>
    @endcannot
@endsection
