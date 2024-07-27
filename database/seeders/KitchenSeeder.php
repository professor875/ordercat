<?php

namespace Database\Seeders;

use App\Models\Kitchen;
use Illuminate\Database\Seeder;

class KitchenSeeder extends Seeder
{
    public function run()
    {
        Kitchen::factory(50)->create();
    }
}
