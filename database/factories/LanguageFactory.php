<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Language>
 */
class LanguageFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => Str::upper(fake()->word),
            'locale' => fake()->languageCode()
        ];
    }
}
