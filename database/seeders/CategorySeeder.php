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
                $category = Category::factory()->create([
                    'store_id' => $store->id,
                    'name' => ucwords($cat),
                    'description' => "Kategori ".ucwords($cat)." untuk ".$store->name,
                ]);

                foreach(range(1,3) as $sub) {
                    Category::factory()->create([
                        'store_id' => $store->id,
                        'name' => "Sub ".$category->name.' '.$sub,
                        'description' => "Sub Kategori ".$sub." dari ".$category->name." untuk ".$store->name,
                        'parent_id' => $category->id,
                    ]);
                }
            }
        });
    }
}
