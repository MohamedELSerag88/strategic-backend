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
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('field');
            $table->date('date');
            $table->string('title');
            $table->date('publication_date');
            $table->text('summary');
            $table->longText('text');
            $table->text('keywords');
            $table->string('main_image');
            $table->string('side_image');
            $table->string('editor_name');
            $table->date('editing_date');
            $table->unsignedBigInteger('new_id');
            $table->foreign('new_id')->references('id')->on('news');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
