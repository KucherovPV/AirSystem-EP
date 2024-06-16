<?php

namespace Database\Seeders;

use App\Models\AircraftModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AircraftModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AircraftModel::truncate();

        $data = [
            [
                'title' => '737',
                'manufacturer_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '747',
                'manufacturer_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'A320',
                'manufacturer_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'A380',
                'manufacturer_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'E175',
                'manufacturer_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'CRJ Series',
                'manufacturer_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'F-35 Lightning II',
                'manufacturer_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '767',
                'manufacturer_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '777',
                'manufacturer_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'A330',
                'manufacturer_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        AircraftModel::insert($data);
    }
}
