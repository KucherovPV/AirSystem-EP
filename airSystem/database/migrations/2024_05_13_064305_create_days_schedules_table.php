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
        Schema::create('days_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('day_id');
            $table->timestamps();

            $table->index('schedule_id','schedule_day_schedule_idx');
            $table->index('day_id','schedule_day_day_idx');
            $table->foreign('schedule_id', 'schedule_day_fk')->on('schedules')->references('id') ;
            $table->foreign('day_id', 'schedule_day__fk')->on('days')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days_schedules');
    }
};
