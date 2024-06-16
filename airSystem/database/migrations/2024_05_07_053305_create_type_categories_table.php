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
        Schema::create('type_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('is_reason_category')->nullable();
            $table->boolean('is_flight_type')->nullable();
            $table->boolean('is_board_type')->nullable();
            $table->boolean('is_reason_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_categories');
    }
};
