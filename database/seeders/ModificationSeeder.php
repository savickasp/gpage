<?php

namespace Database\Seeders;

use App\Models\Modification;
use Illuminate\Database\Seeder;

class ModificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modification::factory()->times(10)->create();
    }
}
