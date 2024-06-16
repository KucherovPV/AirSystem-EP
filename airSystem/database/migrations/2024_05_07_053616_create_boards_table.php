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
        Schema::create('boards', function (Blueprint $table) {
            $table->string('board_code', 7)->primary();
            $table->string('airline_code', 2);
            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('board_type_id');

            $table->timestamps();
            $table->softDeletes();

            $table->index('airline_code','airline_board_idx');
            $table->foreign('airline_code', 'airline_board_fk')->on('airlines')->references('code_iata')->onDelete('cascade');

            $table->index('model_id','board_model_idx');
            $table->foreign('model_id', 'board_model_fk')->on('aircraft_models')->references('id')->onDelete('cascade');

            $table->index('board_type_id','board_type_idx');
            $table->foreign('board_type_id', 'board_type_fk')->on('type_categories')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
