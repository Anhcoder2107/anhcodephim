@extends('admin.layout.maste-admin')
@section('title')
    Assign Roles to Permission
@endsection
@section('container')
    @can('Role Has Permission', Auth::user())
    <div class="content-row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>Assign Roles to Permission</b></div>
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
                <form novalidate="" role="form" class="form-horizontal" method="POST" action="{{ route('admin.permissions.add.post', $permission->id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="permission">Permission Name</label>
                        <div class="col-md-10">
                            <input type="text" id="permission" class="form-control" value="{{ $permission->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="roles">Roles</label>
                        <div class="col-md-10">
                            @foreach($roles as $role)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                            {{ $permission->roles->contains($role->id) ? 'checked' : '' }}>
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
    @cannot('Role Has Permission', Auth::user())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> You don't have permission to assign roles to permission.
        </div>
    @endcannot
@endsection
