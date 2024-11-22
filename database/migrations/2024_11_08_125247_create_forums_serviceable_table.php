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
//        Schema::create('forum_serviceable', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->unsignedBigInteger('discussion_forum_id');
//            $table->morphs('serviceable');
//            $table->foreign('discussion_forum_id')->references('id')->on('discussion_forums');
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_serviceable');
        //
    }
};
