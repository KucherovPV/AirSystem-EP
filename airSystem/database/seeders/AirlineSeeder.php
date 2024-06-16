<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Airline::truncate();

        $data = [
            [
                'code_iata' => 'AA',
                'code_icao' => 'AAL',
                'title' => 'American Airlines',
                'country_id' => 1, // Assuming country ID for the United States
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'BA',
                'code_icao' => 'BAW',
                'title' => 'British Airways',
                'country_id' => 2, // Assuming country ID for the United Kingdom
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more airline records as needed
            [
                'code_iata' => 'AF',
                'code_icao' => 'AFR',
                'title' => 'Air France',
                'country_id' => 6, // Assuming country ID for France
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'LH',
                'code_icao' => 'DLH',
                'title' => 'Lufthansa',
                'country_id' => 5, // Assuming country ID for Germany
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'FV',
                'code_icao' => 'SDM',
                'title' => 'Russian Airlines',
                'country_id' => 10, // Assuming country ID for Russia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'UA',
                'code_icao' => 'UAL',
                'title' => 'United Airlines',
                'country_id' => 1, // Assuming country ID for the United States
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'DL',
                'code_icao' => 'DAL',
                'title' => 'Delta Air Lines',
                'country_id' => 1, // Assuming country ID for the United States
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'U6',
                'code_icao' => 'SVR',
                'title' => 'Ural Airlines',
                'country_id' => 10, // Assuming country ID for Russia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'S7',
                'code_icao' => 'SBI',
                'title' => 'S7 Airlines',
                'country_id' => 10, // Assuming country ID for Russia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'SU',
                'code_icao' => 'AFL',
                'title' => 'Aeroflot',
                'country_id' => 10, // Assuming country ID for Russia
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Airline::insert($data);
    }
}
