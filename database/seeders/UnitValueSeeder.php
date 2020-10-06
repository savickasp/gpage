<?php

namespace Database\Seeders;

use App\Models\UnitValue;
use Illuminate\Database\Seeder;

class UnitValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitValue::factory()->times(10)->create();
    }
}
