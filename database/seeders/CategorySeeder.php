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
            $incomeCats = ['kopi', 'juice', 'snack', 'brunch', 'takeaway'];
            foreach($incomeCats as $cat) {
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

            $expenditureCats = ['bahan baku', 'maintenance', 'biaya', 'sewa', 'piutang'];
            foreach($expenditureCats as $cat) {
                $category = Category::factory()->create([
                    'store_id' => $store->id,
                    'name' => ucwords($cat),
                    'description' => "Kategori ".ucwords($cat)." untuk ".$store->name,
                    'is_expenditure' => true,
                ]);

                foreach(range(1,3) as $sub) {
                    Category::factory()->create([
                        'store_id' => $store->id,
                        'name' => "Sub ".$category->name.' '.$sub,
                        'description' => "Sub Kategori ".$sub." dari ".$category->name." untuk ".$store->name,
                        'parent_id' => $category->id,
                        'is_expenditure' => true,
                    ]);
                }
            }
        });
    }
}
