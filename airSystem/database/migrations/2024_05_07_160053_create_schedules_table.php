<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number', 10);
            $table->date('start_date');
            $table->date('end_date');
            $table->time('boarding_time');
            $table->time('takeoff_time');
            $table->timestamps();
            $table->softDeletes();
            $table->index('flight_number','flight_number_schedule_idx');
            $table->foreign('flight_number', 'flight_number_schedule_fk')->on('flights')->references('flight_number')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
