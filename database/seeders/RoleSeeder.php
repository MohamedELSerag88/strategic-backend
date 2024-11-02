<?php

namespace Database\Seeders;




use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Role::create([
            'name' => "Super Admin"
        ]);
    }
}
