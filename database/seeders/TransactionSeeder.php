<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class TransactionSeeder extends Seeder
{
    use WithFaker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setUpFaker();
        Transaction::truncate();

        Store::all()->each(function($store) {
            $cats = $store->categories()->where('parent_id', 0)->pluck('id')->toArray();
            for($i=3; $i>=0; $i--) {
                for($day=0;$day<=3; $day++) {
                    Transaction::factory()->count(3)->create([
                        'info' => "Income ".$this->faker->colorName,
                        'created_at' => now()->subMonths($i)->subDays($day),
                        'store_id' => $store->id,
                        'category_id' => $this->faker->randomElement($cats)
                    ]);
                    Transaction::factory()->count(3)->expenditure()->create([
                        'info' => "Expenditure ".$this->faker->colorName,
                        'created_at' => now()->subMonths($i)->subDays($day),
                        'store_id' => $store->id,
                        'category_id' => $this->faker->randomElement($cats)
                    ]);
                }
            }
        });
    }
}
