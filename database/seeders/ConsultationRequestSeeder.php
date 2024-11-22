<?php

namespace Database\Seeders;

use App\Models\ConsultationRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultationRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConsultationRequest::query()->delete();
        ConsultationRequest::factory()->count(50)->create();
    }
}
