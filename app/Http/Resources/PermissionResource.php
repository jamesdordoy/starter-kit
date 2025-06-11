<?php

namespace App\Http\Resources;

use App\Data\ActivityData;
use App\Data\PermissionData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...PermissionData::from($this->resource)->toArray(),
        ];
    }
}
