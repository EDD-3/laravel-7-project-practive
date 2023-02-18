<?php

namespace App\Http\Controllers;

use App\Permission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PermissionController extends Controller
{
    //
    public function index () {

        $permissions = Permission::all();

        return view('admin.permissions.index', ['permissions' => $permissions]);
    }


    public function store () {
        request()->validate([
            'name' => ['required', 'string']
        ]);

        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return back();

    }

    public function edit(Permission $permission) {

        return view('admin.permissions.edit', ['permission' => $permission]);
    }

    public function update(Permission $permission)
    {
        request()->validate([
            'name' => ['required', 'string']
        ]);

        

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($permission->isDirty('name')) {
            session()->flash('updated-permission', 'Permission ' . $permission->name . ' was updated');
            $permission->save();

        }

        


        return redirect()->route('Permissions.index');
    }

    public function destroy (Permission $permission) {

        $permission->roles()->detach();

        try {
            $permission->delete();
        } catch (Exception $e) {
        }

        return back();
    }
}
