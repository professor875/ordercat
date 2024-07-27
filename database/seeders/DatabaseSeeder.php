<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            KitchenSeeder::class,
            BuildingSeeder::class,
            ContactSeeder::class,
            ItemSeeder::class,
            StageSeeder::class,
        ]);
    }
}
