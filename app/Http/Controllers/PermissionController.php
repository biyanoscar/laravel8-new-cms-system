<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //
    public function index()
    {
        return view('admin.permissions.index', [
            'permissions' => Permission::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required']
        ]);

        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::slug(request('name'), '-'),
        ]);
        return back();
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission,
            'roles' => Role::all()
        ]);
    }

    public function update(Permission $permission)
    {
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::slug(request('name'), '-');

        if ($permission->isDirty('name')) {
            session()->flash('permission-updated', 'Permission updated: ' . request('name'));
            $permission->save();
        } else {
            session()->flash('permission-updated', 'Nothing has been updated');
        }

        return back();
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('permission-deleted', 'Deleted permission ' . $permission->name);
        return back();
    }

    public function attachRole(Permission $permission)
    {
        $permission->roles()->attach(request('role'));
        return back();
    }

    public function detachRole(Permission $permission)
    {
        $permission->roles()->detach(request('role'));
        return back();
    }
}
