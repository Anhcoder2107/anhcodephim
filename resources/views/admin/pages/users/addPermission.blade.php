@extends('admin.layout.maste-admin')
@section('title')
    Assign Permissions to User
@endsection
@section('container')
    @can('Model Has Permission', Auth::user())
    <div class="content-row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>Assign Permissions to User</b></div>
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
                <form novalidate="" role="form" class="form-horizontal" method="POST" action="{{ route('admin.users.permissions.post', $user->id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="user">User Name</label>
                        <div class="col-md-10">
                            <input type="text" id="user" class="form-control" value="{{ $user->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="permissions">Permissions</label>
                        <div class="col-md-10">
                            @foreach($permissions as $permission)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $user->permissions->contains($permission->id) ? 'checked' : '' }}>
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">Assign Permissions</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
    @cannot('Model Has Permission', Auth::user())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> You don't have permission to assign permissions to user.
        </div>
    @endcannot
@endsection
