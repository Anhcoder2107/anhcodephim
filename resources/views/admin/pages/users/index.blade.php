@extends('admin.layout.maste-admin')
@section('title')
    User Admin
@endsection
@section('container')
    @can('Browse user', Auth::user())

    <div class="content-row">
        <div class="col-md-12 tabbable tabs-right">
            <h1 id="tables" class="page-header">User
            <div class="nav nav-tabs" style="padding-bottom:18px;background-color:white">
                <a href="{{ route('admin.users.create') }}" class="btn-lg btn-primary mt-3">Create User</a>
            </div>
        </h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Add Role</th>
                            <th>Add Permission</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="label label-info">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.show.permissions', $user->id) }}" class="btn btn-primary">Show Permissions</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.add', $user->id) }}" class="btn btn-primary">Add Role</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.permissions', $user->id) }}" class="btn btn-primary">Add Permission</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row content-row-pagination">
        <div class="col-md-12">
            <ul class="pagination">
                @if ($current_page <= 1)
                    <li class="disable"><a href="#">PREV</a></li>
                    @for ($i = 1; $i <= $total_pages; $i++)
                        <li class="">
                            <a href="{{ $path }}?page={{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="active"><a href="{{ $path }}?page={{ $current_page + 1 }}">NEXT</a></li>
                @else
                    <li class="active"><a href="{{ $path }}?page={{ $current_page - 1 }}">PREV</a></li>
                    @for ($i = 1; $i <= $total_pages; $i++)
                        <li class="">
                            <a href="{{ $path }}?page={{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="active"><a href="{{ $path }}?page={{ $current_page + 1 }}">NEXT</a></li>
                @endif
            </ul>
        </div>
    </div>
    @endcan
    @cannot('Browse user', Auth::user())
        <div class="alert alert-danger">
            <strong>Sorry!</strong> You don't have permission to browse user.
        </div>
    @endcannot
@endsection
