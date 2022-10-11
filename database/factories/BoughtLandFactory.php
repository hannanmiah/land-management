<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoughtLand>
 */
class BoughtLandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'document_id' => $this->faker->uuid,
            'amount' => $this->faker->randomDigit(),
            'issued_at' => $this->faker->date
        ];
    }
}
