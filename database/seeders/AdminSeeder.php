<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('admin12345');
        $user_password = Hash::make('test');

        $admin_records = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'phone_number' => '+254 746 055 487',
                'password' => $password,
                'user_level' => 1,
            ],
            [
                'first_name' => 'Test',
                'last_name' => 'Testing',
                'email' => 'test@gmail.com',
                'phone_number' => '+254 700 000 012',
                'password'=> $user_password,
                'user_level' => 2, 
            ],
            [
                'first_name' => 'Test',
                'last_name' => 'TestingActive',
                'email' => 'test1@gmail.com',
                'phone_number' => '+254 711  112 000',
                'password' => $user_password,
                'user_level' => 2,
            ],
            [
                'first_name' => 'User',
                'last_name' => 'UserActive',
                'email' => 'test2@gmail.com',
                'phone_number' => '+254 701 001 002',
                'password' => $user_password,
                'user_level' => 2,
            ],
        ];

        foreach($admin_records as $admin_record) {
            User::create($admin_record);
        }

    }
}
