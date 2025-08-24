<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'Admin',
            'phone' => '0789483241',
            'role' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);

         User::create([
            'name' => 'Tester',
            'phone' => '0789483251',
            'role' => 'User',
            'email' => 'tester@gmail.com',
            'password' => Hash::make('password')
        ]);
               
        User::factory()
            ->count(10)
            ->create();
    }
}
