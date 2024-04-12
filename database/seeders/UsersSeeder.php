<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username'  => 'admin',
            'is_admin'  => 1,
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('admin1234')
        ]);

        User::create([
            'username'  => 'user',
            'is_admin'  => 0,
            'email'     => 'user@user.com',
            'password'  => Hash::make('user1234')
        ]);
    }
}
