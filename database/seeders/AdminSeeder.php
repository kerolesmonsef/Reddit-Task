<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([]);
        User::create([
            'profile_id' => $admin->id,
            'profile_type' => Admin::class,
            'email' => "admin@admin.com",
            'name' => "admin",
            'password' => bcrypt("12345678"),
        ]);
    }
}
