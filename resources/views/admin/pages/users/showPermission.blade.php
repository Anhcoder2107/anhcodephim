@extends('admin.layout.maste-admin')
@section('title')
    User Permissions
@endsection
@section('container')
    <div class="content-row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>User Permissions</b></div>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="user">User Name</label>
                    <div class="col-md-10">
                        <input type="text" id="user" class="form-control" value="{{ $user->name }}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="permissions">Permissions</label>
                    <div class="col-md-10">
                        <ul class="list-group">
                            @foreach($allPermissions as $permission)
                                <li class="list-group-item">{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">Back to Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
