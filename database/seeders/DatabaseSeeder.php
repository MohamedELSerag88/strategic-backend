<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
//            RoleSeeder::class,
//            AdminSeeder::class,
//            FeatureSeeder::class,
            CategorySeeder::class,
            ConsultationSeeder::class,
            ExpertSeeder::class,
            EventSeeder::class,
            StudySeeder::class,
            ConsultationRequestSeeder::class,
            DiscussionForumSeeder::class,
            EventRequestSeeder::class,
            MembershipSeeder::class,
            NewsSeeder::class,
            OpinionMeasurementSeeder::class
        ]);
    }
}
