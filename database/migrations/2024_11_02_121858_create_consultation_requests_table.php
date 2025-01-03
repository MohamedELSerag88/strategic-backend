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
        Schema::create('consultation_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('job_position');
            $table->string('email');
            $table->string('phone');
            $table->string('org_status');
            $table->string('org_name');
            $table->string('org_type');
            $table->date('establishment_date');
            $table->string('ownership_type');
            $table->string('means_type');
            $table->string('headquarter_country');
            $table->string('employees_number');
            $table->string('external_offices_number');
            $table->string('annual_budget');
            $table->string('suffers_area')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_requests');
    }
};
