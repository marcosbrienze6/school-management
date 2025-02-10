<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomDigit(),
            'name' => fake()->name(),
            'registration_number' => fake()->randomDigitNotZero(7),
            'grade_module' => fake()->numberBetween(1,3),
            'birth_date' => now()
        ];
    }
}
