<?php

namespace Database\Seeders;

use App\Models\DiscussionForum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscussionForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DiscussionForum::query()->delete();
        DiscussionForum::factory()->count(50)->create();
    }
}
