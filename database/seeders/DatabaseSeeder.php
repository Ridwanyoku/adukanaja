<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::create([
            'nik' => '12345678',
            'name' => 'User Test 1',
            'username' => 'user1',
            'password' => Hash::make('12345678'),
            'telephone' => '08123456789',
        ]);
        
        User::create([
            'nik' => '111111111',
            'name' => 'User Test 2',
            'username' => 'user2',
            'password' => Hash::make('111111111'),
            'telephone' => '08123456789',
        ]);

        Admin::create([
            'name' => 'Admin',
            'username' => 'super-admin',
            'password' => Hash::make('12345678'),
            'telephone' => '08123456788',
            'level' => 'admin',
        ]);

        Admin::create([
            'name' => 'Staff',
            'username' => 'staff1',
            'password' => Hash::make('12345678'),
            'telephone' => '08123456787',
            'level' => 'staff',
        ]);
    }
}