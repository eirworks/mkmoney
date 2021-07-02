<?php

namespace Database\Seeders;

use App\Models\IncomeRecord;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class IncomeRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncomeRecord::truncate();

        $start = now()->subMonths(3)->startOfMonth();
        $end = now()->endOfMonth();

        $period = CarbonPeriod::create($start, $end);
        foreach($period as $date) {
            if (now()->eq($date) || now()->lt($date)) {
                continue;
            }
            IncomeRecord::factory()->create([
                'date' => $date->toDateString()
            ]);
        }
    }
}
