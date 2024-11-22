<?php

namespace Database\Seeders;

use App\Models\EventRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventRequest::query()->delete();
        EventRequest::factory()->count(50)->create();
    }
}
