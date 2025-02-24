@extends('admin.layout.maste-admin')
@section('title')
    Add Actor Admin
@endsection
@section('container')
    @can('Movie Has Actor', Auth::user())
    <div class="content-row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>Add Actor Movie</b>
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
                <form novalidate="" role="form" class="form-horizontal" method="POST" action="{{ route('admin.actors.add.post', $id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="actor">Select Actor</label>
                        <div class="col-md-8">
                            <select id="actor" class="form-control select2" name="actor_id">
                                <option value="">-- Select Actor --</option>
                                @foreach ($actors as $actor)
                                    <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.actors.create') }}" class="btn btn-primary">Add New</a>
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
    @endcan
    @cannot('Movie Has Actor', Auth::user())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> You don't have permission to add actor to movie.
        </div>
    @endcannot
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "-- Select Director --",
                allowClear: true
            });
        });
    </script>
@endsection

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
