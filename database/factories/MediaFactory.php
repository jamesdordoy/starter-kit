<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        $fileName = $this->faker->word.'.'.$this->faker->randomElement(['jpg', 'png', 'pdf']);

        return [
            'model_type' => User::class,
            'model_id' => User::factory(),
            'collection_name' => 'default',
            'name' => $fileName,
            'file_name' => $fileName,
            'mime_type' => $this->faker->mimeType(),
            'disk' => 'public',
            'size' => $this->faker->numberBetween(1000, 1000000),
            'manipulations' => [],
            'custom_properties' => [],
            'generated_conversions' => [],
            'responsive_images' => [],
            'order_column' => 1,
            'client_name' => $fileName,
            'client_extension' => pathinfo($fileName, PATHINFO_EXTENSION),
        ];
    }
}
