<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Store::all()->each(function($store) {
            Category::factory()->count(5)->create([
                'store_id' => $store->id,
            ]);
        });
    }
}
