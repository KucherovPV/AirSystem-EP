<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountrySeeder::class);
        $this->call(ManufacturerSeeder::class);
        $this->call(AircraftModelSeeder::class);
        $this->call(AirlineSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(TypeCategorySeeder::class);
        $this->call(BoardSeeder::class);
        $this->call(FlightSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(DayScheduleSeeder::class);

    }
}
