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
        Schema::create('experts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('photo')->nullable();
            $table->text('about')->nullable();
            $table->string('specialization');
            $table->string('job');
            $table->text('practical_experiences');
            $table->text('training_courses');
            $table->text('academic_qualifications');
            $table->text('research');
            $table->text('nationality');
            $table->text('resident_country');
            $table->text('phone');
            $table->text('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experts');
    }
};
