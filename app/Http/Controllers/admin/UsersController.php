<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        $current_page = $users->currentPage();
        $total_pages = $users->lastPage();
        $path = $users->path();
        return view('admin.pages.users.index', compact('users', 'current_page', 'total_pages', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(){
        return view('admin.pages.users.create');
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',

        ]);

        // check confirmation password
        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors([
                'password' => 'The password confirmation does not match.',
            ]);
        }

        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]
        );

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'nullable|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
    ]);

    // check confirmation password
    if ($request->password !== $request->password_confirmation) {
        return back()->withErrors([
            'password' => 'The password confirmation does not match.',
        ]);
    }

    $user = User::find($id);
    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('admin.users')->with('success', 'User updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function addGet(string $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.pages.users.addRole', compact('user', 'roles'));
    }

    public function addPost(Request $request, string $id)
    {
        $user = User::find($id);
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users')->with('success', 'Role added successfully.');
    }

    public function addPermissions(string $id)
    {
        $user = User::find($id);
        $permissions = Permission::all();
        return view('admin.pages.users.addPermission', compact('user', 'permissions'));
    }

    public function addPermissionsPost(Request $request, string $id)
    {
        $user = User::find($id);
        $user->permissions()->sync($request->permissions);
        return redirect()->route('admin.users')->with('success', 'Permission added successfully.');
    }

    public function showPermissions($id)
{
    $user = User::find($id);
    $directPermissions = $user->permissions;
    $rolePermissions = $user->roles->flatMap->permissions;
    $allPermissions = $directPermissions->merge($rolePermissions)->unique('id');

    return view('admin.pages.users.showPermission', compact('user', 'allPermissions'));
}
}
