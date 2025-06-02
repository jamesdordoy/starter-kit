<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Activity as SpatieActivity;

class Activity extends SpatieActivity
{
    #[Scope]
    public function search(Builder $query, ?string $search): Builder
    {
        if (! $search) {
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

    #[Scope]
    public function date(Builder $query, ?string $date): Builder
    {
        if (! $date) {
            return $query;
        }

        return $query->whereDate('created_at', $date);
    }

    #[Scope]
    public function dateFrom(Builder $query, ?string $date): Builder
    {
        if (! $date) {
            return $query;
        }

        return $query->whereDate('created_at', '>=', $date);
    }

    #[Scope]
    public function dateTo(Builder $query, ?string $date): Builder
    {
        if (! $date) {
            return $query;
        }

        return $query->whereDate('created_at', '<=', $date);
    }

    #[Scope]
    public function dateRange(Builder $query, ?array $from, ?array $to): Builder
    {
        $fromDate = Carbon::createFromDate(...collect($from)
            ->only(['year', 'month', 'day'])
            ->map(fn($value) => (int) $value)
            ->values());

        $toDate = Carbon::createFromDate(...collect($to)
            ->only(['year', 'month', 'day'])
            ->map(fn($value) => (int) $value)
            ->values());

        return $query->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate);
    }
}
