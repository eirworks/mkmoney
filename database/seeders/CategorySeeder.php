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
            $cats = ['bahan baku', 'maintenance', 'biaya', 'sewa', 'piutang'];
            foreach($cats as $cat) {
                Category::factory()->create([
                    'store_id' => $store->id,
                    'name' => ucwords($cat),
                    'description' => "Kategori ".ucwords($cat)." untuk ".$store->name,
                ]);
            }
        });
    }
}
