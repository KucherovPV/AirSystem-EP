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
        Schema::create('airlines', function (Blueprint $table) {
            $table->string('code_iata', 2)->primary();
            $table->string('code_icao', 3);
            $table->string('title');
            $table->unsignedBigInteger('country_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('country_id','airline_country_idx');
            $table->foreign('country_id', 'airline_country_fk')->on('countries')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airlines');
    }
};
