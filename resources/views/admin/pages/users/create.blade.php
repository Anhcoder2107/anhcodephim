@extends('admin.layout.maste-admin')
@section('title')
    Create User
@endsection
@section('container')
    @can('Create user', Auth::user())

    <div class="content-row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>Create User</b></div>
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
                <form novalidate="" role="form" class="form-horizontal" method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">Name</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Name" id="name" class="form-control"
                            name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="email">Email</label>
                        <div class="col-md-10">
                            <input type="email" required="" placeholder="Email" id="email" class="form-control"
                            name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="password">Password</label>
                        <div class="col-md-10">
                            <input type="password" required="" placeholder="Password" id="password" class="form-control"
                            name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="password_confirmation">Confirm Password</label>
                        <div class="col-md-10">
                            <input type="password" required="" placeholder="Confirm Password" id="password_confirmation" class="form-control"
                            name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
    @cannot('Create user', Auth::user())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> You don't have permission to create user.
        </div>
    @endcannot
@endsection
