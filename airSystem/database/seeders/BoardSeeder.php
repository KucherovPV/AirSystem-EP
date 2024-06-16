<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Board::truncate();
        $data = [
            [
                'board_code' => 'ABC123',
                'airline_code' => 'AA',
                'model_id' => 1, // Assuming model ID
                'board_type_id' => 10, // Assuming board type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'board_code' => 'DEF456',
                'airline_code' => 'BA',
                'model_id' => 2, // Assuming model ID
                'board_type_id' => 11, // Assuming board type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records as needed
            [
                'board_code' => 'GHI789',
                'airline_code' => 'AF',
                'model_id' => 3, // Assuming model ID
                'board_type_id' => 10, // Assuming board type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'board_code' => 'JKL012',
                'airline_code' => 'LH',
                'model_id' => 4, // Assuming model ID
                'board_type_id' => 10, // Assuming board type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'board_code' => 'MNO345',
                'airline_code' => 'FV',
                'model_id' => 5, // Assuming model ID
                'board_type_id' => 11, // Assuming board type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'board_code' => 'PQR678',
                'airline_code' => 'UA',
                'model_id' => 6, // Assuming model ID
                'board_type_id' => 11, // Assuming board type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'board_code' => 'STU901',
                'airline_code' => 'DL',
                'model_id' => 7, // Assuming model ID
                'board_type_id' => 10, // Assuming board type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'board_code' => 'VWX234',
                'airline_code' => 'U6',
                'model_id' => 8, // Assuming model ID
                'board_type_id' => 11, // Assuming board type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'board_code' => 'YZA567',
                'airline_code' => 'S7',
                'model_id' => 9, // Assuming model ID
                'board_type_id' => 11, // Assuming board type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'board_code' => 'BCD890',
                'airline_code' => 'SU',
                'model_id' => 10, // Assuming model ID
                'board_type_id' => 11, // Assuming board type ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Board::insert($data);
    }
}
