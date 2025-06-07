<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Media extends SpatieMedia
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        self::creating(function ($media) {
            $media->generateClientMeta();
        });

        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generateClientMeta(): self
    {
        if ($this->client_name) {
            $this->client_name = Str::beforeLast($this->client_name, ':upload:');
            $this->client_extension = pathinfo($this->client_name, PATHINFO_EXTENSION);
        }

        return $this;
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
