<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::insert([
            [
                'name'     => 'Isna Qudsiatul Aulia',
                'email'    => 'admin@smk.com',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ],
            [
                'name'     => 'Dherry',
                'email'    => 'operator@smk.com',
                'username' => 'operator',
                'password' => Hash::make('op123'),
                'role'     => 'operator',
            ]
        ]);
    }
}
