<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'staff']);
        Role::create(['name' => 'loaner']);

        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'address' => 'Jl. Jendral Sudirman No. 1',
            'email' => 'admin@ujikom',

        ]);

        $userStaff = User::create([
            'name' => 'Staff',
            'username' => 'staff',
            'password' => bcrypt('staff'),
            'address' => 'Jl. Jendral Sudirman No. 1',
            'email' => 'staff@ujikom',
        ]);

        $user->assignRole('administrator');
        $userStaff->assignRole('staff');
    }
}
