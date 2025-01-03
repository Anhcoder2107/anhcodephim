<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Roles;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Roles::paginate(10);
        $current_page = $roles->currentPage();
        $total_pages = $roles->lastPage();
        $path = $roles->path();
        return view('admin.pages.roles.index', compact('roles', 'current_page', 'total_pages', 'path'));
    }

    public function create()
    {
        return view('admin.pages.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Role::create(
            [
                'name' => $request->name,
            ]
        );

        return redirect()->route('admin.roles')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('admin.pages.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = Role::find($id);
        $role->update(
            [
                'name' => $request->name,
            ]
        );

        return redirect()->route('admin.roles')->with('success', 'Role updated successfully.');
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        return redirect()->route('admin.roles')->with('success', 'Role deleted successfully.');
    }


    public function addGet($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('admin.pages.roles.addPermission', compact('role', 'permissions'));
    }

    public function addPost(Request $request, $id)
    {
        // dd($request->all());
        $role = Role::find($id);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles')->with('success', 'Permission added successfully.');
    }

}
