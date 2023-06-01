<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(5), 
            'total_slots' => $this->faker->numberBetween(1,30), 
            'price' => $this->faker->randomDigit, 
            'imgUrl' => $this->faker->name
        ];
    }
}
