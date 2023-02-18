<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', ['role' => $role, 'permissions' => Permission::all()]);
    }

    public function store()
    {

        request()->validate([
            'name' => ['required', 'string']
        ]);

        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return back();
    }

    public function update(Role $role)
    {
        request()->validate([
            'name' => ['required', 'string']
        ]);

        

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($role->isDirty('name')) {
            session()->flash('updated-role', 'Role ' . $role->name . ' was updated');
            $role->save();

        }

        


        return redirect()->route('roles.index');
    }

    public function attach_permission(Role $role) {

        $role->permissions()->attach(request('permission'));

        return back();
    }

    public function detach_permission (Role $role) {
        
        $role->permissions()->detach(request('permission'));

        return back();
    }



    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('deleted-role', 'Role ' . $role->name . ' was deleted');

        return back();
    }
}
