<?php

namespace App\Http\Resources;

use App\Data\ActivityData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...ActivityData::from($this->resource)->toArray(),
        ];
    }
} 