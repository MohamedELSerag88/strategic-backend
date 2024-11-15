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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('duration');
            $table->string('job')->nullable();
            $table->string('nationality')->nullable();
            $table->string('resident_country');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->string('contact_type')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
