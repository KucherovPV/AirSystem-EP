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
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('country_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('country_id','country_manufacturer_idx');
            $table->foreign('country_id', 'country_manufacturer_fk')->on('countries')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manufacturers');
    }
};
