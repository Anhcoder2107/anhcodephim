@extends('admin.layout.maste-admin')
@section('title')
    Assign Permissions to Role
@endsection
@section('container')
    <div class="content-row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>Assign Permissions to Role</b></div>
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
                <form novalidate="" role="form" class="form-horizontal" method="POST" action="{{ route('admin.roles.add.post', $role->id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="role">Role Name</label>
                        <div class="col-md-10">
                            <input type="text" id="role" class="form-control" value="{{ $role->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="permissions">Permissions</label>
                        <div class="col-md-10">
                            @foreach($permissions as $permission)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
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
@endsection
