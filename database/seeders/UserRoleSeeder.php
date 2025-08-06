<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => '0', // admin
        ]);

        User::create([
            'name' => 'Employee User1',
            'email' => 'employee1@example.com',
            'password' => Hash::make('password'),
            'role' => '1', // employee
        ]);
        User::create([
            'name' => 'Employee User2',
            'email' => 'employee2@example.com',
            'password' => Hash::make('password'),
            'role' => '1', // employee
        ]);
    }
}
