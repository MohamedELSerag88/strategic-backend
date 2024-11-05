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
        Schema::create('opinion_measurements_related', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('related_id');
            $table->unsignedBigInteger('opinion_measurement_id');
            $table->foreign('opinion_measurement_id')->references('id')->on('opinion_measurements');
            $table->foreign('related_id')->references('id')->on('opinion_measurements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
