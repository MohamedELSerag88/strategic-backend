<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
             'ندوة', 'دورة', 'محاضرة',
        ];
        Category::query()->delete();
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
