@extends('admin.layout.maste-admin')
@section('title')
    Edit Movies | $movie->name
@endsection
@section('container')
    <div class="content-row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>Edit Movie</b>
                </div>

                <div class="panel-options">
                    <a class="bg" data-target="#sample-modal-dialog-1" data-toggle="modal" href="#sample-modal"><i
                            class="entypo-cog"></i></a>
                    <a data-rel="collapse" href="#"><i class="entypo-down-open"></i></a>
                    <a data-rel="close" href="#!/tasks" ui-sref="Tasks"><i class="entypo-cancel"></i></a>
                </div>
            </div>

            <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form novalidate="" role="form" class="form-horizontal" method="POST" action="{{ route('admin.movies.update', $movie->id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">Name</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Name" id="name" class="form-control"
                                name="name" value="{{ old('name', $movie->name) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="origin_name">Origin Name</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Origin Name" id="origin_name" class="form-control"
                                name="origin_name" value="{{ old('origin_name', $movie->origin_name) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="slug">Slug</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Slug" id="slug" class="form-control"
                                name="slug" value="{{ old('slug', $movie->slug) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">Content</label>
                        <div class="col-md-10">
                            <textarea required="" class="form-control" placeholder="Content" rows="10" cols="30" id="description"
                                name="content">{{ old('content', $movie->content) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="thumb_url">Thumb_url</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Thumb_url" id="thumb_url" class="form-control"
                                name="thumb_url" value="{{ old('thumb_url', $movie->thumb_url) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="poster_url">Poster_url</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Poster_url" id="poster_url" class="form-control"
                                name="poster_url" value="{{ old('poster_url', $movie->poster_url) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Type</label>
                        <div class="col-md-10">
                            <select name="type" class="selecter_4">
                                <option value="single" {{ old('type', $movie->type) == 'single' ? 'selected' : '' }}>Single</option>
                                <option value="series" {{ old('type', $movie->type) == 'series' ? 'selected' : '' }}>Series</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Status</label>
                        <div class="col-md-10">
                            <select name="status" class="selecter_4">
                                <option value="trailer" {{ old('status', $movie->status) == 'trailer' ? 'selected' : '' }}>Trailer</option>
                                <option value="ongoing" {{ old('status', $movie->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="completed" {{ old('status', $movie->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="trailer_url">Trailer_url</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Trailer_url" id="trailer_url" class="form-control"
                                name="trailer_url" value="{{ old('trailer_url', $movie->trailer_url) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="episode_time">Episode_time</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="episode_time" id="episode_time" class="form-control"
                                name="episode_time" value="{{ old('episode_time', $movie->episode_time) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="episode_current">Episode_current</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Episode_current" id="episode_current" class="form-control"
                                name="episode_current" value="{{ old('episode_current', $movie->episode_current) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="episode_total">Episode_total</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Episode_total" id="episode_total" class="form-control"
                                name="episode_total" value="{{ old('episode_total', $movie->episode_total) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="quality">Quality</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Quality" id="quality" class="form-control"
                                name="quality" value="{{ old('quality', $movie->quality) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="language">Language</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Language" id="language" class="form-control"
                                name="language" value="{{ old('language', $movie->language) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="notify">Notify</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Notify" id="notify" class="form-control"
                                name="notify" value="{{ old('notify', $movie->notify) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="showtimes">Showtimes</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Showtimes" id="showtimes" class="form-control"
                                name="showtimes" value="{{ old('showtimes', $movie->showtimes) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="publish_year">Publish_year</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Publish_year" id="publish_year" class="form-control"
                                name="publish_year" value="{{ old('publish_year', $movie->publish_year) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
