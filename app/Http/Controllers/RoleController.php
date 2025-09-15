<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('role-permission.role.index', compact('roles'));
    }
    public function create()
    {
        $permissions = Permission::all(); 
        return view('role-permission.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'array' 
        ]);

    
        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role created and permissions assigned successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all(); 
        $rolePermissions = $role->permissions->pluck('name')->toArray(); 

        return view('role-permission.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array' 
        ]);

      
        $role->update(['name' => $request->name]);

      
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    public function givePermissions(Role $role)
    {
        $permissions = Permission::all(); 
        $rolePermissions = $role->permissions->pluck('name')->toArray(); 

        return view('role-permission.role.give-permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    public function storePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array' 
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions); 
        } else {
            $role->syncPermissions([]); 
        }

        return redirect()->route('roles.index')->with('success', 'Permissions updated successfully.');
    }
}
