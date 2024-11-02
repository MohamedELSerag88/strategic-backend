<?php

namespace Database\Seeders;



use App\Models\Admin;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Admin::create([
            'name' => "Admin",
            'email' => "admin@admin.com",
            'password' => \Hash::make("123456"),
            'role_id' => Role::first()->id,
            'email_verified_at' =>Carbon::now()
        ]);
    }
}
