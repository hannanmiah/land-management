<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plot>
 */
class PlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->uuid,
            'no' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->word(),
            'amount' => $this->faker->randomDigit(),
            'document_id' => $this->faker->uuid
        ];
    }
}
