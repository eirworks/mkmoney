<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id' => 1,
            'name' => $this->faker->safeColorName,
            'description' => $this->faker->sentences(3, true),
            'color' => $this->faker->hexColor,
            'parent_id' => 0,
        ];
    }
}
