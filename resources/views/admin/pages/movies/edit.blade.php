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
                <form novalidate="" role="form" class="form-horizontal" method="POST" action="{{ route('admin.movies.update', $movie->id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">Name</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Name" id="name" class="form-control"
                            value="{{ $movie->name }}"
                                name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="origin_name">Origin Name</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Origin Name" id="origin_name" class="form-control"
                            value="{{ $movie->origin_name }}"
                                name="origin_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="slug">Slug</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Slug" id="slug" class="form-control"
                            value="{{ $movie->slug }}"
                                name="slug">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">Content</label>
                        <div class="col-md-10">
                            <textarea required="" class="form-control" placeholder="Content" rows="10" cols="30" id="description"
                                value="{{ $movie->content }}"
                            name="content"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="thumb_url">Thumb_url</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Thumb_url" id="thumb_url" class="form-control"
                                value="{{ $movie->thumb_url }}"
                                name="thumb_url">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="poster_url">Poster_url</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Poster_url" id="poster_url" class="form-control"
                                value="{{ $movie->poster_url }}"
                                name="poster_url">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Type</label>
                        <div class="col-md-10">
                            <select name="type" class="selecter_4" >
                                @if($movie->type == 'single')
                              <option value="single" selected>Single</option>
                              <option value="series">Series</option>
                                @else
                                <option value="single">Single</option>
                              <option value="series" selected>Series</option>
                                @endif
                            </select>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Status</label>
                        <div class="col-md-10">
                            <select name="status" class="selecter_4" >
                                @if($movie->status == 'trailer')
                              <option value="trailer" selected>Trailer</option>
                              <option value="ongoing">Ongoing</option>
                              <option value="completed">Completed</option>
                                @elseif($movie->status == 'ongoing')
                                <option value="trailer">Trailer</option>
                                <option value="ongoing" selected>Ongoing</option>
                                <option value="completed">Completed</option>
                                @else
                                <option value="trailer">Trailer</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed" selected>Completed</option>
                                @endif
                            </select>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="trailer_url">Trailer_url</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Trailer_url" id="trailer_url" class="form-control"
                                value="{{ $movie->trailer_url }}"
                                name="trailer_url">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="episode_time">Episode_time</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="episode_time" id="episode_time" class="form-control"
                                value="{{ $movie->episode_time }}"
                                name="episode_time">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="episode_current">Episode_current</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Episode_current" id="episode_current"
                            class="form-control"
                                value="{{ $movie->episode_current }}"
                                name="episode_current">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="episode_total">Episode_total</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Episode_total" id="episode_total" class="form-control"
                                value="{{ $movie->episode_total }}"
                                name="episode_total">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="quality">Quality</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Quality" id="quality" class="form-control"
                                value="{{ $movie->quality }}"
                                name="quality">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="language">Language</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Language" id="language" class="form-control"
                                value="{{ $movie->language }}"
                                name="language">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="notify">Notify</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Notify" id="notify" class="form-control"
                                value="{{ $movie->notify }}"
                                name="notify">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="showtimes">Showtimes</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Showtimes" id="showtimes" class="form-control"
                                value="{{ $movie->showtimes }}"
                                name="showtimes">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="publish_year">Publish_year</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Publish_year" id="publish_year" class="form-control"
                                value="{{ $movie->publish_year }}"
                                name="publish_year">
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
