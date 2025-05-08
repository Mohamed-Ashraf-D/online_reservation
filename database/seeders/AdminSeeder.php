<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=Admin::create([
            'name' => 'Admin',
            'email' => 'admin@reservation.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole('super_admin');


    }
}
