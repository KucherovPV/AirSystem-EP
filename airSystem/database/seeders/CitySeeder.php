<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::truncate();
        $data = [
            [
                'title' => 'Москва',
                'country_id' => 10, // Assuming country ID for Russia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Санкт-Петербург',
                'country_id' => 10, // Assuming country ID for Russia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Екатеринбург',
                'country_id' => 10, // Assuming country ID for Russia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Новосибирск',
                'country_id' => 10, // Assuming country ID for Russia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Краснодар',
                'country_id' => 10, // Assuming country ID for Russia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Нью-Йорк',
                'country_id' => 1, // Assuming country ID for the United States
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Лондон',
                'country_id' => 2, // Assuming country ID for the United Kingdom
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Париж',
                'country_id' => 6, // Assuming country ID for France
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Токио',
                'country_id' => 7, // Assuming country ID for Japan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Берлин',
                'country_id' => 5, // Assuming country ID for Germany
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        City::insert($data);
    }
}
