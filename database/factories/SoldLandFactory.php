<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SoldLand>
 */
class SoldLandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'plot_id' => $this->faker->uuid,
            'document_id' => $this->faker->uuid,
            'amount' => $this->faker->randomNumber(),
            'statement_no' => $this->faker->randomNumber(),
            'issued_at' => $this->faker->date
        ];
    }
}
