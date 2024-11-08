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
        //
        Schema::create('news_related_news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('related_id');
            $table->unsignedBigInteger('news_id');
            $table->foreign('related_id')->references('id')->on('news')->onDelete('cascade');
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('news_related_news');
    }
};
