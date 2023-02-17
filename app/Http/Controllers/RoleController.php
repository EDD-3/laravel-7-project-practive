<?php

namespace App\Http\Controllers;

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
        return view('admin.roles.edit', ['role' => $role]);
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

        session()->flash('updated-role', 'Role ' . $role->name . ' was updated');

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        $role->save();



        return redirect()->route('roles.index');
    }



    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('deleted-role', 'Role ' . $role->name . ' was deleted');

        return back();
    }
}
