@extends('admin.layout.maste-admin')
@section('title')
    Movies Admin
@endsection
@section('container')
    @can('Browse movie', Auth::user())
    <div class="content-row">
        <div class="col-md-12">
            <h1 id="tables" class="page-header">Movies</h1>
            {{-- them nut sreach --}}
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.movies.search') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Movie Name</th>
                            <th>Movie Origin_name</th>
                            <th>Movie Slug</th>
                            <th>Movie Content</th>
                            <th>Movie Thumb_url</th>
                            <th>Movie Poster_url</th>
                            <th>Movie Type</th>
                            <th>Movie Status</th>
                            <th>Movie Rating</th>
                            <th>Movie Espisoder_time</th>
                            <th>Movie Espisoder_current</th>
                            <th>Movie Espisoder_total</th>
                            <th>Movie Language</th>
                            <th>Movie View Total</th>
                            <th>Movie View Today</th>
                            <th>Movie View Week</th>
                            <th>Movie View Month</th>
                            <th>Movie Rating Count</th>
                            <th>Movie Rating Star</th>
                            <th>Movie Episodes</th>
                            <th>Movie Actors</th>
                            <th>Movie Directors</th>
                            <th>Movie Categories</th>
                            <th>Movie Regions</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <td>{{ $movie->id }}</td>
                                <td>{{ $movie->name }}</td>
                                <td>{{ $movie->origin_name }}</td>
                                <td>{{ $movie->slug }}</td>
                                <td>
                                    @if(Str::length($movie->content) > 100)
                                        {{ Str::limit($movie->content, 100) }}
                                    @else
                                        {{ $movie->content }}
                                    @endif
                                </td>
                                <td>{{ $movie->thumb_url }}</td>
                                <td>{{ $movie->poster_url }}</td>
                                <td>{{ $movie->type }}</td>
                                <td>{{ $movie->status }}</td>
                                <td>{{ $movie->rating }}</td>
                                <td>{{ $movie->espisoder_time }}</td>
                                <td>{{ $movie->espisoder_current }}</td>
                                <td>{{ $movie->espisoder_total }}</td>
                                <td>{{ $movie->language }}</td>
                                <td>{{ $movie->view_total }}</td>
                                <td>{{ $movie->view_day }}</td>
                                <td>{{ $movie->view_week }}</td>
                                <td>{{ $movie->view_month }}</td>
                                <td>{{ $movie->rating_count }}</td>
                                <td>{{ $movie->rating_star }}</td>
                                <td>
                                    <a href="{{ route('admin.episodes.movie_id', $movie->id) }}" class="btn btn-primary">Episodes</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.actors.movie_id', $movie->id) }}" class="btn btn-primary" >Actors</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.directors.movie_id', $movie->id) }}" class="btn btn-primary">Directors</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.movie_id', $movie->id) }}" class="btn btn-primary">Categories</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.regions.movie_id', $movie->id) }}" class="btn btn-primary">Regions</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.movies.delete', $movie->id) }}" method="POST">
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
    @cannot('Browse movie', Auth::user())
    <div class="alert alert-danger" role="alert">
        You don't have permission to access this page.
    </div>
    @endcannot
@endsection
