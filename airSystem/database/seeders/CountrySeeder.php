<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::truncate();

        $countries =  [
            [
                'title' => 'Соединенные Штаты Америки',
                'code' => 'US',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Соединенное Королевство',
                'code' => 'UK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Канада',
                'code' => 'CA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Австралия',
                'code' => 'AU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Германия',
                'code' => 'DE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Франция',
                'code' => 'FR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Япония',
                'code' => 'JP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Бразилия',
                'code' => 'BR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Индия',
                'code' => 'IN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Россия',
                'code' => 'RU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

       Country::insert($countries);
    }
}
