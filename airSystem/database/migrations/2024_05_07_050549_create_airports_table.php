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
        Schema::create('airports', function (Blueprint $table) {
            $table->string('code_iata', 3)->primary();
            $table->string('code_icao', 4);
            $table->string('title');
            $table->string('coordinates');
            $table->unsignedBigInteger('city_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('city_id','airport_city_idx');
            $table->foreign('city_id', 'airport_city_fk')->on('cities')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
