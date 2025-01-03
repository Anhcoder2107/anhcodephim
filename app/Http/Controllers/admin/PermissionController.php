<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permissions;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permissions::paginate(10);
        $current_page = $permissions->currentPage();
        $total_pages = $permissions->lastPage();
        $path = $permissions->path();
        return view('admin.pages.permissions.index', compact('permissions', 'current_page', 'total_pages', 'path'));
    }

    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Permission::create(
            [
                'name' => $request->name,
            ]
        );

        return redirect()->route('admin.permissions')->with('success', 'Permission created successfully.');
    }

    public function edit($id)
    {
        $permission = Permissions::find($id);
        return view('admin.pages.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->update(
            [
                'name' => $request->name,
            ]
        );

        return redirect()->route('admin.permissions')->with('success', 'Permission updated successfully.');
    }

    public function delete($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('admin.permissions')->with('success', 'Permission deleted successfully.');
    }


    public function addGet($id)
    {
        $permission = Permission::find($id);
        $roles = Role::all();
        return view('admin.pages.permissions.addRole', compact('permission', 'roles'));
    }

    public function addPost(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->roles()->sync($request->roles);

        return redirect()->route('admin.permissions')->with('success', 'Roles assigned successfully.');
    }

}
