<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manufacturer::truncate();

        $data =  [
            [
                'title' => 'Boeing',
                'country_id' => 1,// США
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Airbus',
                'country_id' => 6, // Франция
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Embraer',
                'country_id' => 8, // Бразилия
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bombardier Aerospace',
                'country_id' => 3, // Канада
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Lockheed Martin',
                'country_id' => 1, // США
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Manufacturer::insert($data);
    }
}
