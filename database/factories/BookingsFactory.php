<?php

namespace Database\Factories;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookings>
 */
class BookingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name,
            'product' => $this->faker->text(5), 
            'amount_paid' => $this->faker->randomDigit, 
            'duration' => $this->faker->numberBetween(1,4), 
            'quantity' => $this->faker->numberBetween(1,4), 
            'booked_date_time' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+ 1 month', $timezone = null)
        ];
    }
}
