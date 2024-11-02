<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Feature;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $features = [
            [
                'key' =>'roles'
            ],
            [
                'key' =>'admins'
            ],
            [
                'key' =>'experts'
            ],
            [
                'key' =>'memberships'
            ],
            [
                'key' =>'pages'
            ],
            [
                'key' =>'consultations'
            ],
            [
                'key' =>'categories'
            ],
            [
                'key' =>'experts'
            ],
            [
                'key' =>'events'
            ],
            [
                'key' =>'studies'
            ],
            [
                'key' =>'opinion_measurements'
            ],
            [
                'key' =>'discussion_forums'
            ],
            [
                'key' =>'users'
            ],
            [
                'key' =>'news'
            ]
        ];
        Feature::insert($features);

        $role = Role::find(1);
        $role->permissions()->attach(Feature::all()->pluck('id')->toArray());
    }
}
