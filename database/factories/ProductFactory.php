<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'article' => fake()->unique()->numerify('###'),
            'price' => fake()->randomFloat(2, 0, 1000),
            'description' => fake()->realText(),
            'user_id' => fake()->randomElement( User::all()->pluck('id')->toArray()),
        ];
    }
}
