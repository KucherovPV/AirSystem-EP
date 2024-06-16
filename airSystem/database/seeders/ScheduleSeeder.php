<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;


class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::truncate();
        $data = [
            [
                'flight_number' => 'AA123',
                'start_date' => '01.01.2024',
                'end_date' => '01.01.2025',
                'boarding_time' => '01:00:00',
                'takeoff_time' => '04:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'BA456',
                'start_date' => '01.01.2024',
                'end_date' => '01.01.2025',
                'boarding_time' => '02:00:00',
                'takeoff_time' => '06:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'AF789',
                'start_date' => '01.01.2024',
                'end_date' => '01.01.2025',
                'boarding_time' => '03:00:00',
                'takeoff_time' => '07:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'LH012',
                'start_date' => '01.01.2024',
                'end_date' => '01.01.2025',
                'boarding_time' => '07:00:00',
                'takeoff_time' => '11:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'FV345',
                'start_date' => '01.01.2024',
                'end_date' => '01.01.2025',
                'boarding_time' => '09:00:00',
                'takeoff_time' => '15:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'UA678',
                'start_date' => '01.01.2024',
                'end_date' => '01.01.2025',
                'boarding_time' => '14:00:00',
                'takeoff_time' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'DL901',
                'start_date' => '01.01.2024',
                'end_date' => '01.01.2025',
                'boarding_time' => '16:00:00',
                'takeoff_time' => '20:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'U6234',
                'start_date' => '01.01.2024',
                'end_date' => '01.01.2025',
                'boarding_time' => '17:00:00',
                'takeoff_time' => '21:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'S7567',
                'start_date' => '01.01.2024',
                'end_date' => '01.01.2025',
                'boarding_time' => '18:00:00',
                'takeoff_time' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'flight_number' => 'SU890',
                'start_date' => '01.01.2024',
                'end_date' => '01.01.2025',
                'boarding_time' => '19:00:00',
                'takeoff_time' => '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Schedule::insert($data);
    }
}
