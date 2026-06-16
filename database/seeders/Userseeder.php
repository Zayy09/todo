<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'status' => 'active',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@example.com',
            'role' => 'staff',
            'status' => 'active',
            'password' => bcrypt('staff'),
        ]);
    }
}
