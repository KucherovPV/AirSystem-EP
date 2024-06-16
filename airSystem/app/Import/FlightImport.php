<?php

namespace App\Import;

use App\Models\Flight;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FlightImport implements ToCollection
{

        public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Flight::create([
                'flight_number' => $row[0],
                'board_code' => $row[1],
                'airport_code_where' => $row[2],
                'airport_code_whither' => $row[3],
                'airline_code' => $row[4],
                'flight_type_id' => $row[5],
            ]);
        }
    }
}
