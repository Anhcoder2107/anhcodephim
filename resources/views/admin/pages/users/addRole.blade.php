@extends('admin.layout.maste-admin')
@section('title')
    Assign Roles to User
@endsection
@section('container')
    @can('Model Has Role', Auth::user())
    <div class="content-row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>Assign Roles to User</b></div>
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
                <form novalidate="" role="form" class="form-horizontal" method="POST" action="{{ route('admin.users.add.post', $user->id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="user">User Name</label>
                        <div class="col-md-10">
                            <input type="text" id="user" class="form-control" value="{{ $user->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="roles">Roles</label>
                        <div class="col-md-10">
                            @foreach($roles as $role)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                            {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">Assign Roles</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
    @cannot('Model Has Role', Auth::user())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> You don't have permission to assign roles to user.
        </div>
    @endcannot
@endsection
