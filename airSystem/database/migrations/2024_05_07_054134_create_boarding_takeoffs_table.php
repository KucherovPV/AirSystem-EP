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
        Schema::create('boarding_takeoffs', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_boarding');
            $table->boolean('status_completed');
            $table->dateTime('planed_date_time');

            $table->timestamp('completed_date_time')->nullable();

            $table->string('flight_number', 10);
            $table->string('airport_code', 3);
            $table->timestamps();
            $table->softDeletes();

            $table->index('flight_number','flight_number_boarding_idx');
            $table->foreign('flight_number', 'flight_number_boarding_fk')->on('flights')->references('flight_number')->onDelete('cascade');

            $table->index('airport_code','airport_code_boarding_idx');
            $table->foreign('airport_code', 'airport_code_boarding_fk')->on('airports')->references('code_iata')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_takeoffs');
    }
};
