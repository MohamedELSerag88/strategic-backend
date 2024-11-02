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
        Schema::create('discussion_forums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->text("subject");
            $table->string("domain");
            $table->integer("participants");
            $table->date("start_date");
            $table->date("end_date");
            $table->unsignedBigInteger('discussion_forum_id');
            $table->foreign('discussion_forum_id')->references('id')->on('discussion_forums');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussion_forums');
    }
};
