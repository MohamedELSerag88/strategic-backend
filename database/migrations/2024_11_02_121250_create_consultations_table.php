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
        Schema::create('consultations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('scope_of_work',['Establish','Develop','Analysis','Measurement','Supervision','Other'])->default('Establish');
            $table->text('goal');
            $table->text('summary');
            $table->longText('stages');
            $table->string('duration');
            $table->unsignedBigInteger('consultations_id')->nullable();
            $table->foreign('consultations_id')->references('id')->on('consultations');
            $table->integer('course_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
