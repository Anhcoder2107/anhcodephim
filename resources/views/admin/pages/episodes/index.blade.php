@extends('admin.layout.maste-admin')
@section('title')
    Episosdes Admin
@endsection
@section('container')

    <div class="content-row">
        <div class="col-md-12">
            <h1 id="tables" class="page-header">Episodes</h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Episoder Movie Name</th>
                            <th>Episoder server</th>
                            <th>Episoder Name</th>
                            <th>Episoder Slug</th>
                            <th>Episoder Type</th>
                            <th>Episoder Link</th>
                            <th>Episoder Report</th>
                            <th>Episoder Report Message</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($episodes as $episode)
                            <tr>
                                <td>{{ $episode->id }}</td>
                                <td>{{ $episode->movie->name }}</td>
                                <td>{{ $episode->server }}</td>
                                <td>{{ $episode->name }}</td>
                                <td>{{ $episode->slug }}</td>
                                <td>{{ $episode->type }}</td>
                                <td>{{ $episode->link }}</td>
                                <td>{{ $episode->has_report }}</td>
                                <td>{{ $episode->report_message }}</td>
                                <td>
                                    <a href="{{ route('admin.movies.edit', $episode->movie_id) }}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.movies.delete', $episode->movie_id) }}" method="POST">
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
@endsection
