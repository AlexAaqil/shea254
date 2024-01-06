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
        $password = 'admin12345';

        $admin_records = [
            'first_name' => 'Admin',
            'last_name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'phone_number' => '+254 746 055 487',
            'password' => $password,
            'profile_picture' => '',
            'user_level' => 1,
        ];

        foreach($admin_records as $admin_record) {
            User::create($admin_record);
        }

    }
}
