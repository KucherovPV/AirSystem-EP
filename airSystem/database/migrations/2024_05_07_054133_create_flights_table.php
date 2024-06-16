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
        Schema::create('flights', function (Blueprint $table) {
            $table->string('flight_number', 10)->primary();
            $table->string('board_code', 7);
            $table->string('airport_code_where', 3);
            $table->string('airport_code_whither', 3);
            $table->string('airline_code', 2);
            $table->unsignedBigInteger('flight_type_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('board_code','board_flight_idx');
            $table->foreign('board_code', 'board_flight_fk')->on('boards')->references('board_code')->onDelete('cascade');

            $table->index('airport_code_where','airport_code_where_flight_idx');
            $table->foreign('airport_code_where', 'airport_code_where_flight_fk')->on('airports')->references('code_iata')->onDelete('cascade');

            $table->index('airport_code_whither','airport_code_whither_flight_idx');
            $table->foreign('airport_code_whither', 'airport_code_whither_flight_fk')->on('airports')->references('code_iata')->onDelete('cascade');

            $table->index('airline_code','airline_code_flight_idx');
            $table->foreign('airline_code', 'airline_code_flight_fk')->on('airlines')->references('code_iata')->onDelete('cascade');

            $table->index('flight_type_id','flight_type_id_flight_idx');
            $table->foreign('flight_type_id', 'flight_type_id_flight_fk')->on('type_categories')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
