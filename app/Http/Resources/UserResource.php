<?php

namespace App\Http\Resources;

use App\Data\UserData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...UserData::from($this->resource)->toArray(),
        ];
    }
}
