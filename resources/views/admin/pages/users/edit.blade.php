@extends('admin.layout.maste-admin')
@section('title')
    Edit User
@endsection
@section('container')
    <div class="content-row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>Edit User</b></div>
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
                <form novalidate="" role="form" class="form-horizontal" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">Name</label>
                        <div class="col-md-10">
                            <input type="text" required="" placeholder="Name" id="name" class="form-control"
                            name="name" value="{{ old('name', $user->name) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="email">Email</label>
                        <div class="col-md-10">
                            <input type="email" required="" placeholder="Email" id="email" class="form-control"
                            name="email" value="{{ old('email', $user->email) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="password">Password</label>
                        <div class="col-md-10">
                            <input type="password" placeholder="Password" id="password" class="form-control"
                            name="password">
                            <small class="text-muted">Leave blank if you don't want to change the password</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="password_confirmation">Confirm Password</label>
                        <div class="col-md-10">
                            <input type="password" placeholder="Confirm Password" id="password_confirmation" class="form-control"
                            name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
