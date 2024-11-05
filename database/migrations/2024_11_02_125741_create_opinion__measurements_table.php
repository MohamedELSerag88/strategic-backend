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
        Schema::create('opinion_measurements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->text("subject");
            $table->string("domain");
            $table->string("targeted_segment");
            $table->string("geographical_scope");
            $table->integer("participants");
            $table->date("start_date");
            $table->date("end_date");
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
        Schema::dropIfExists('opinion_measurements');
    }
};
