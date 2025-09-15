<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenaltyType;

class PenaltyTypeSeeder extends Seeder
{
    public function run()
    {
        PenaltyType::updateOrCreate(['name' => 'Late Return'], ['amount' => 100]);
        PenaltyType::updateOrCreate(['name' => 'Lost Book'], ['amount' => 500]);
    }
}
