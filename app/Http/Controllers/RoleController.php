<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required']
        ]);

        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::slug(request('name'), '-'),
        ]);
        // dd(request('name'));
        return back();
    }

    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('role-deleted', 'Deleted Role ' . $role->name);
        return back();
    }


    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    public function attachPermission(Role $role)
    {
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detachPermission(Role $role)
    {
        $role->permissions()->detach(request('permission'));
        return back();
    }

    public function update(Role $role)
    {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::slug(request('name'), '-');

        if ($role->isDirty('name')) {
            session()->flash('role-updated', 'Role Updated: ' . request('name'));
            $role->save();
        } else {
            session()->flash('role-updated', 'Nothing has been updated');
        }


        return back();
    }
}
