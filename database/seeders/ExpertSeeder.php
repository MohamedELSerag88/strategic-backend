<?php

namespace Database\Seeders;

use App\Models\Expert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expert::query()->delete();
        Expert::factory()->count(50)->create();
    }
}
