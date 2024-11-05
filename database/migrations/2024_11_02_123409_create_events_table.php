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
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('specialization');
            $table->text('objective');
            $table->text('main_axes');
            $table->text('main_knowledge');
            $table->text('main_skills');
            $table->string('presentation_format');
            $table->integer('duration');
            $table->string('duration_type');
            $table->float('price');
            $table->unsignedBigInteger('expert_id');

            $table->foreign('expert_id')->references('id')->on('experts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
