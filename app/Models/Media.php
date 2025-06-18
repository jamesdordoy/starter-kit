<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Media extends SpatieMedia
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    #[Scope]
    public function search(Builder $query, ?string $search): Builder
    {
        if (! $search) {
            return $query;
        }

        return $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        });
    }
}
