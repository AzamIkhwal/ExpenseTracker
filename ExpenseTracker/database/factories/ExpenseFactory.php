<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Category' => $this->faker->randomElements(['Food', 'Transportation', 'Utilities', 'Entertainment', 'Miscellaneous'])[0],
            'Amount' => $this->faker->numberBetween($min = 150, $max = 250),
            'Date' => $this->faker->dateTimeBetween('-60days', 'now'),
        ];
    }
}
