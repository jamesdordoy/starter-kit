<?php

namespace App\Models;

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
            $this->client_name =  Str::beforeLast($this->client_name, ':upload:');
            $this->client_extension = pathinfo($this->client_name, PATHINFO_EXTENSION);
        }

        return $this;
    }

    public function createMediaActivity($action = 'uploaded', Model $related = null)
    {
        activity()
            ->performedOn($this)
            ->causedBy(Auth::user())
            ->withProperties([
                'attributes' => [
                    $this->toArray(),
                    ...[
                        'related' => $related?->toArray() ?? []
                    ]
                ]
            ])
            ->log($this->client_name . ' ' . $action);
    }
}
