<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UnavailableDays>
 */
class UnavailableDaysFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'to_date_time' => $this->faker->dateTimeBetween($startDate = '+ 7 days', $endDate = '+ 1 month', $timezone = null), 
            'from_date_time' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+ 7 days', $timezone = null)
        ];
    }
}
