<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Days;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Days::truncate();
        $data = [
            [
                'title' => 'Понедельник',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Вторник',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Среда',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Четверг',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Пятница',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Суббота',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Воскресенье',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Days::insert($data);
    }
}
