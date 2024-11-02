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
        Schema::create('studies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->unsignedBigInteger('expert_id');
            $table->foreign('expert_id')->references('id')->on('experts');
            $table->string('specialization');
            $table->integer('page_numbers');
            $table->date('publication_date');
            $table->text('main_topics');
            $table->text('summary');
            $table->text('file')->nullable();
            $table->unsignedBigInteger('study_id')->nullable();
            $table->foreign('study_id')->references('id')->on('studies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studies');
    }
};
