<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1=User::create([
            'name' => 'user',
            'email' => 'user@reservation.com',
            'password' => Hash::make('password123'),
        ]);
        $user1->assignRole('normal_user');
        $user2=User::create([
            'name' => 'user',
            'email' => 'coaching@reservation.com',
            'password' => Hash::make('password123'),
        ]);
        $user2->assignRole('user_coaching');

        $user3=User::create([
            'name' => 'user',
            'email' => 'repair@reservation.com',
            'password' => Hash::make('password123'),
        ]);
        $user3->assignRole('user_repairs');

        $user4=User::create([
            'name' => 'user',
            'email' => 'consultation@reservation.com',
            'password' => Hash::make('password123'),
        ]);
        $user4->assignRole('user_consultation');

    }
}
