<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'user_consultation', 'guard_name' => 'admin']);
        Role::create(['name' => 'user_repairs', 'guard_name' => 'admin']);
        Role::create(['name' => 'user_coaching', 'guard_name' => 'admin']);
        Role::create(['name' => 'normal_user','guard_name' => 'web']);
        Role::create(['name' => 'admin','guard_name' => 'admin']);
    }
}
