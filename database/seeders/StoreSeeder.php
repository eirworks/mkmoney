<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::truncate();

        User::all()->each(function($user) {
            Store::factory()->count(3)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
