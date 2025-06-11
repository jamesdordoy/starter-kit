<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Activitylog\LogOptions;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        return [
            'log_name' => 'default',
            'description' => $this->faker->sentence,
            'subject_type' => User::class,
            'subject_id' => User::factory(),
            'causer_type' => User::class,
            'causer_id' => User::factory(),
            'properties' => [
                'attributes' => [],
                'old' => [],
            ],
            'event' => $this->faker->randomElement(['created', 'updated', 'deleted']),
            'batch_uuid' => $this->faker->uuid,
        ];
    }
} 