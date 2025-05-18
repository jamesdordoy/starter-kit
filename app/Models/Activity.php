<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Activity as SpatieActivity;

class Activity extends SpatieActivity
{
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($query) use ($search) {
            $query->where('description', 'like', "%{$search}%")
                ->orWhere('properties', 'like', "%{$search}%")
                ->orWhereHas('causer', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
        });
    }

    public function scopeDate(Builder $query, ?string $date): Builder
    {
        if (!$date) {
            return $query;
        }

        return $query->whereDate('created_at', $date);
    }

    public function scopeDateFrom(Builder $query, ?string $date): Builder
    {
        if (!$date) {
            return $query;
        }

        return $query->whereDate('created_at', '>=', $date);
    }

    public function scopeDateTo(Builder $query, ?string $date): Builder
    {
        if (!$date) {
            return $query;
        }

        return $query->whereDate('created_at', '<=', $date);
    }
} 