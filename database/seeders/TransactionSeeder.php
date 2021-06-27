<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::truncate();

        Store::all()->each(function($store) {
            for($i=3; $i>=0; $i--) {
                Transaction::factory()->count(3)->create([
                    'created_at' => now()->subMonths($i),
                    'store_id' => $store->id,
                ]);
            }
        });
    }
}
