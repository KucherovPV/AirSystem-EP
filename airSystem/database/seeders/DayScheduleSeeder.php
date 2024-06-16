<?php

namespace Database\Seeders;


use App\Models\DaysSchedule;
use Illuminate\Database\Seeder;

class DayScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DaysSchedule::truncate();
        $data = [
            [
                'schedule_id' => 1,
                'day_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 1,
                'day_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 1,
                'day_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 2,
                'day_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 2,
                'day_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 2,
                'day_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 3,
                'day_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 3,
                'day_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 3,
                'day_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 4,
                'day_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 4,
                'day_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 4,
                'day_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 5,
                'day_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 5,
                'day_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 5,
                'day_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 6,
                'day_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 6,
                'day_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 6,
                'day_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 7,
                'day_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 7,
                'day_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 7,
                'day_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 8,
                'day_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 8,
                'day_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 8,
                'day_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 9,
                'day_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 9,
                'day_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 9,
                'day_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 10,
                'day_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 10,
                'day_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'schedule_id' => 10,
                'day_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DaysSchedule::insert($data);
    }
}
