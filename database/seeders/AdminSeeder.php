<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::firstWhere('name', 'admin');

        $admin = User::updateOrCreate(
            ['email' => 'libraryadmin@gmail.com'],
            [
                'name' => 'Administrator',
                'email' => 'libraryadmin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('dtclib2021'),
                'student_id' => null,
                'department_id' => null,
            ]
        );

        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }
    }
}
