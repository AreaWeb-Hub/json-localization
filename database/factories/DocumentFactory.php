<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'data' => [
                [
                    'key' => fake()->word(),
                    'value' => fake()->sentence(),
                ],
                [
                    'key' => fake()->word(),
                    'value' => fake()->sentence(),
                ],
                [
                    'key' => fake()->word(),
                    'value' => fake()->sentence(),
                ]
            ]
        ];
    }
}
