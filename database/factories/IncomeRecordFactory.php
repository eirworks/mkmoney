<?php

namespace Database\Factories;

use App\Models\IncomeRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IncomeRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id' => 1,
            'date' => now(),
            'amount' => rand(1, 9) * rand(1,8) * 1000,
            'user_id' => 1,
        ];
    }
}
