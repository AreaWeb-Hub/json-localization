<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use function Symfony\Component\String\s;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->sentence(4),
            'description' => fake()->text(50),
            'source_language_id' => Language::query()->inRandomOrder()->first()->id,
            'target_language_ids' => Language::query()
                ->select('id')
                ->inRandomOrder()
                ->limit(3)
                ->get()
                ->map(function ($el) {
                    return $el->id;
                })
                ->toArray(),
            'use_machine_translate' => fake()->boolean
        ];
    }
}
