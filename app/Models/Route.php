<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\RouteFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[UseFactory(RouteFactory::class)]
final class Route extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(Permission::class, 'route_permission');
    }
}
