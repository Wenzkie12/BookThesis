<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'add books',
            'reserve books',
            'edit books',
            'delete books',
            'manage reservations',
            'edit users',
            'delete users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);
        $userRole  = Role::firstOrCreate(['name' => 'user']);

        $adminPermissions = array_filter($permissions, function ($permission) {
            return !in_array($permission, ['manage reservations', 'reserve books']);
        });
        $adminRole->syncPermissions($adminPermissions);

        $staffPermissions = [
            'add books',
            'reserve books',
            'edit books',
            'manage reservations',
        ];
        $staffRole->syncPermissions($staffPermissions);

        $userPermissions = [
            'reserve books',
        ];
        $userRole->syncPermissions($userPermissions);
    }
}
