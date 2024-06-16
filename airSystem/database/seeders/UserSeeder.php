<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        $data = [
            [
                'role' => 0, // Assuming role ID for regular user
                'first_name' => 'Павел',
                'last_name' => 'Кучеров',
                'patronymic' => 'Витальевич',
                'email' => 'admin@mail.ru',
                'email_verified_at' => now(),
                'password' => bcrypt('123123123'), // You should use a secure hashing function here
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 1, // Assuming role ID for administrator
                'first_name' => 'Павел',
                'last_name' => 'Кучеров',
                'patronymic' => 'Витальевич',
                'email' => 'analyst@mail.ru',
                'email_verified_at' => now(),
                'password' => bcrypt('123123123'), // You should use a secure hashing function here
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 2, // Assuming role ID for regular user
                'first_name' => 'Павел',
                'last_name' => 'Кучеров',
                'patronymic' => 'Витальевич',
                'email' => 'operator@mail.ru',
                'email_verified_at' => now(),
                'password' => bcrypt('123123123'), // You should use a secure hashing function here
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        User::insert($data);
    }
}
