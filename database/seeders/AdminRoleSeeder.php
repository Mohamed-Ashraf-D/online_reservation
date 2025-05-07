<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $role = Role::firstOrCreate(['name' => 'admin'], ['guard_name' => 'admin']);

        // جيب الأدمن
        $admin = Admin::find(1);

        if ($admin) {
            $admin->assignRole('admin');
            echo "Admin role assigned successfully.\n";
        } else {
            echo "Admin with ID 1 not found.\n";
        }

        $user = User::find(1);

        if ($user) {
            $user->assignRole('normal_user');
            echo "Admin role assigned successfully.\n";
        } else {
            echo "Admin with ID 1 not found.\n";
        }
    }
}
