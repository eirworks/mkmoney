<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::factory()->create([
            'name' => "Admin",
            'email' => 'dev@cc.cc',
            'password' => Hash::make("dev"),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory()->count(15)->create();
    }
}
