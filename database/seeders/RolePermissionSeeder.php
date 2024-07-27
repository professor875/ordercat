<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('constants.permissions') as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], $permission);
        }

        Role::updateOrCreate(['name' => Role::admin])->givePermissionTo(collect(config('constants.permissions'))->pluck('name')->toArray());
        Role::updateOrCreate(['name' => 'sub admin']);
        Role::updateOrCreate(['name' => 'employee']);
    }
}
