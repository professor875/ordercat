<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create(['email' => 'admin@system.com'])->assignRole('admin');
//        User::factory()->create(['email' => 'client@system.com'])->assignRole(Role::client);
    }
}
