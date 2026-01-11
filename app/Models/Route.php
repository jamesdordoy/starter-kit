<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Route extends Model
{
    protected $fillable = [
        'name',
        'uri',
        'method',
        'label',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'route_permission');
    }
}
