<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delays', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_process')->default(true);
            $table->bigInteger('approximate_time');
            $table->string('airport_code', 3);
            $table->string('flight_number', 10);
            $table->unsignedBigInteger('boarding_takeoff_id');
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->unsignedBigInteger('reason_type_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('airport_code', 'airport_code_delay_idx');
            $table->foreign('airport_code', 'airport_code_delay_fk')->on('airports')->references('code_iata')->onDelete('cascade');

            $table->index('flight_number','flight_number_boarding_tkf_idx');
            $table->foreign('flight_number', 'flight_number_boarding_tkf_fk')->on('flights')->references('flight_number')->onDelete('cascade');

            $table->index('reason_type_id','reason_type_idx');
            $table->foreign('reason_type_id', 'reason_type_fk')->on('type_categories')->references('id')->onDelete('cascade');

            $table->index('boarding_takeoff_id','boarding_takeoff_id_idx');
            $table->foreign('boarding_takeoff_id', 'boarding_takeoff_id_fk')->on('boarding_takeoffs')->references('id')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delays');
    }
};
