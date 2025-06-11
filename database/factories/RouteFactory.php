<?php

namespace Database\Factories;

use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

class RouteFactory extends Factory
{
    protected $model = Route::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'uri' => $this->faker->unique()->url,
            'method' => $this->faker->randomElement(['GET', 'POST', 'PUT', 'DELETE']),
            'label' => $this->faker->sentence(3),
        ];
    }
} 