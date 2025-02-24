@extends('admin.layout.maste-admin')
@section('title')
    Edit Directors Admin
@endsection
@section('container')
    @can('Update director', Auth::user())
    <div class="content-row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>Edit Directors Movie</b>
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
                <form novalidate="" role="form" class="form-horizontal" method="POST" action="{{ route('admin.directors.update', $id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">Directors Name</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Name" id="name" class="form-control"
                                value="{{ $director->name }}"
                            name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="slug">Directors Slug</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Slug" id="slug" class="form-control"
                                value="{{ $director->slug }}"
                                name="slug">
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
    @cannot('Update director', Auth::user())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> You don't have permission to edit director.
        </div>
    @endcannot
@endsection
