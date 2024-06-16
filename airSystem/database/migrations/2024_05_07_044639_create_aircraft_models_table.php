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
        Schema::create('aircraft_models', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('manufacturer_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('manufacturer_id','model_manufacturer_idx');
            $table->foreign('manufacturer_id', 'model_manufacturer_fk')->on('manufacturers')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aircraft_models');
    }
};
