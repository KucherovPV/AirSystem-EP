<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Airport::truncate();
        $data = [
            [
                'code_iata' => 'MOW', // Assuming IATA code for Moscow
                'code_icao' => 'UUDD', // Assuming ICAO code for Moscow
                'title' => 'Шереметьево',
                'coordinates' => '55.972642, 37.414589', // Assuming coordinates for Sheremetyevo Airport
                'city_id' => 1, // Assuming city ID for Moscow
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'LED', // Assuming IATA code for St. Petersburg
                'code_icao' => 'ULLI', // Assuming ICAO code for St. Petersburg
                'title' => 'Пулково',
                'coordinates' => '59.800292, 30.262503', // Assuming coordinates for Pulkovo Airport
                'city_id' => 2, // Assuming city ID for St. Petersburg
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'SVX', // Assuming IATA code for Yekaterinburg
                'code_icao' => 'USSS', // Assuming ICAO code for Yekaterinburg
                'title' => 'Кольцово',
                'coordinates' => '56.743108, 60.802019', // Assuming coordinates for Koltsovo Airport
                'city_id' => 3, // Assuming city ID for Yekaterinburg
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'OVB', // Assuming IATA code for Novosibirsk
                'code_icao' => 'UNNT', // Assuming ICAO code for Novosibirsk
                'title' => 'Толмачево',
                'coordinates' => '55.012622, 82.650656', // Assuming coordinates for Tolmachevo Airport
                'city_id' => 4, // Assuming city ID for Novosibirsk
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'KRR', // Assuming IATA code for Krasnodar
                'code_icao' => 'URKK', // Assuming ICAO code for Krasnodar
                'title' => 'Пашковский',
                'coordinates' => '45.034309, 39.170555', // Assuming coordinates for Pashkovsky Airport
                'city_id' => 5, // Assuming city ID for Krasnodar
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'JFK', // Assuming IATA code for New York
                'code_icao' => 'KJFK', // Assuming ICAO code for New York
                'title' => 'John F. Kennedy International Airport',
                'coordinates' => '40.641311, -73.778139', // Assuming coordinates for JFK Airport
                'city_id' => 6, // Assuming city ID for New York
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'LHR', // Assuming IATA code for London
                'code_icao' => 'EGLL', // Assuming ICAO code for London
                'title' => 'London Heathrow Airport',
                'coordinates' => '51.470020, -0.454295', // Assuming coordinates for Heathrow Airport
                'city_id' => 7, // Assuming city ID for London
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'CDG', // Assuming IATA code for Paris
                'code_icao' => 'LFPG', // Assuming ICAO code for Paris
                'title' => 'Charles de Gaulle Airport',
                'coordinates' => '49.009720, 2.547770', // Assuming coordinates for CDG Airport
                'city_id' => 8, // Assuming city ID for Paris
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'HND', // Assuming IATA code for Tokyo
                'code_icao' => 'RJTT', // Assuming ICAO code for Tokyo
                'title' => 'Haneda Airport',
                'coordinates' => '35.548889, 139.784722', // Assuming coordinates for Haneda Airport
                'city_id' => 9, // Assuming city ID for Tokyo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_iata' => 'TXL', // Assuming IATA code for Berlin
                'code_icao' => 'EDDT', // Assuming ICAO code for Berlin
                'title' => 'Berlin Tegel Airport',
                'coordinates' => '52.559722, 13.287778', // Assuming coordinates for TXL Airport
                'city_id' => 10, // Assuming city ID for Berlin
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        Airport::insert($data);
    }
}
