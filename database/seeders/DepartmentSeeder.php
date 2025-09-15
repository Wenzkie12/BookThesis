<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = ['BSIS', 'BS Tourism', 'BS Criminology', 'BTVTED'];
        $yearLevels = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
        $sections = ['A', 'B'];

        foreach ($departments as $dept) {
            foreach ($yearLevels as $year) {
                foreach ($sections as $section) {
                    Department::create([
                        'department' => $dept,
                        'year_level' => $year,
                        'section' => $section,
                    ]);
                }
            }
        }
    }
}
