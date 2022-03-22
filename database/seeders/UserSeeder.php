<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'adimi@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);
    }
}
