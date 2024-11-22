<?php

namespace Database\Seeders;

use App\Models\OpinionMeasurement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpinionMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OpinionMeasurement::query()->delete();
        OpinionMeasurement::factory()->count(50)->create();
    }
}
