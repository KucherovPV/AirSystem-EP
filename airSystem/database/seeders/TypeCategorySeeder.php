<?php

namespace Database\Seeders;

use App\Models\TypeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeCategory::truncate();
        $data = [
            [
                'title' => 'Технические проблемы',
                'is_reason_category' => true,
                'is_flight_type' => false,
                'is_board_type' => false,
                'is_reason_status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Отмена рейса',
                'is_reason_category' => true,
                'is_flight_type' => false,
                'is_board_type' => false,
                'is_reason_status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Пассажирский рейс',
                'is_reason_category' => false,
                'is_flight_type' => true,
                'is_board_type' => false,
                'is_reason_status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Грузовой рейс',
                'is_reason_category' => false,
                'is_flight_type' => true,
                'is_board_type' => false,
                'is_reason_status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Чартерный рейс',
                'is_reason_category' => false,
                'is_flight_type' => true,
                'is_board_type' => false,
                'is_reason_status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'В процессе рассмотрения',
                'is_reason_category' => false,
                'is_flight_type' => false,
                'is_board_type' => false,
                'is_reason_status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Подтверждено',
                'is_reason_category' => false,
                'is_flight_type' => false,
                'is_board_type' => false,
                'is_reason_status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Погодные условия',
                'is_reason_category' => true,
                'is_flight_type' => false,
                'is_board_type' => false,
                'is_reason_status' => false,
                'created_at' =>  now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Грузовое',
                'is_reason_category' => false,
                'is_flight_type' => false,
                'is_board_type' => true,
                'is_reason_status' => false,
                'created_at' =>  now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Грузо-пассажирское',
                'is_reason_category' => false,
                'is_flight_type' => false,
                'is_board_type' => true,
                'is_reason_status' => false,
                'created_at' =>  now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Пассажирское',
                'is_reason_category' => false,
                'is_flight_type' => false,
                'is_board_type' => true,
                'is_reason_status' => false,
                'created_at' =>  now(),
                'updated_at' => now(),
            ],
        ];
        TypeCategory::insert($data);
    }
}
