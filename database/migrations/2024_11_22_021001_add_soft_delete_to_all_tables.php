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
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('consultations', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('consultation_requests', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('discussion_forums', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('events', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('event_requests', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('experts', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('memberships', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('opinion_measurements', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('studies', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('news', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('consultations', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('consultation_requests', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('discussion_forums', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('events', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('event_requests', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('experts', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('memberships', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('opinion_measurements', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('studies', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('news', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
    }
};
