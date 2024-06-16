<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Flight::truncate();
        $data = [
            [
                'flight_number' => 'AA123',
                'board_code' => 'ABC123',
                'airport_code_where' => 'JFK',
                'airport_code_whither' => 'LED',
                'airline_code' => 'AA',
                'flight_type_id' => 3, // Assuming flight type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'BA456',
                'board_code' => 'DEF456',
                'airport_code_where' => 'LHR',
                'airport_code_whither' => 'CDG',
                'airline_code' => 'BA',
                'flight_type_id' => 4, // Assuming flight type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records as needed
            [
                'flight_number' => 'AF789',
                'board_code' => 'GHI789',
                'airport_code_where' => 'CDG',
                'airport_code_whither' => 'JFK',
                'airline_code' => 'AF',
                'flight_type_id' => 3, // Assuming flight type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'LH012',
                'board_code' => 'JKL012',
                'airport_code_where' => 'HND',
                'airport_code_whither' => 'LHR',
                'airline_code' => 'LH',
                'flight_type_id' => 5, // Assuming flight type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'FV345',
                'board_code' => 'MNO345',
                'airport_code_where' => 'MOW',
                'airport_code_whither' => 'JFK',
                'airline_code' => 'FV',
                'flight_type_id' => 3, // Assuming flight type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'UA678',
                'board_code' => 'PQR678',
                'airport_code_where' => 'OVB',
                'airport_code_whither' => 'LHR',
                'airline_code' => 'UA',
                'flight_type_id' => 4, // Assuming flight type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'DL901',
                'board_code' => 'STU901',
                'airport_code_where' => 'KRR',
                'airport_code_whither' => 'LHR',
                'airline_code' => 'DL',
                'flight_type_id' => 4, // Assuming flight type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'U6234',
                'board_code' => 'VWX234',
                'airport_code_where' => 'LED',
                'airport_code_whither' => 'MOW',
                'airline_code' => 'U6',
                'flight_type_id' => 5, // Assuming flight type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'S7567',
                'board_code' => 'YZA567',
                'airport_code_where' => 'CDG',
                'airport_code_whither' => 'MOW',
                'airline_code' => 'S7',
                'flight_type_id' => 3, // Assuming flight type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'SU890',
                'board_code' => 'BCD890',
                'airport_code_where' => 'MOW',
                'airport_code_whither' => 'JFK',
                'airline_code' => 'SU',
                'flight_type_id' => 4, // Assuming flight type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Flight::insert($data);
    }
}
