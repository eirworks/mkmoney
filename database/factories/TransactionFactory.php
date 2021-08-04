<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id' => 1,
            'category_id' => 1,
            'info' => "Transaksi ".$this->faker->colorName,
            'amount' => rand(1, 99) * 1000,
            'shop' => 'Toko '.$this->faker->streetName,
            'qty' => $this->faker->boolean ? 1 : rand(1, 3),
            'unit' => 'unit',
            'purchased_at' => now(),
        ];
    }

    public function expenditure()
    {
        return $this->state(function() {
            return [
                'amount' => rand(1, 99) * 1000 * -1,
            ];
        });
    }
}
