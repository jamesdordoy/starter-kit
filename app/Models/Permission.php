<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\PermissionFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission as SpatiePermission;

#[UseFactory(PermissionFactory::class)]
final class Permission extends SpatiePermission
{
    use HasFactory;

    public function routes(): BelongsToMany
    {
        return $this->belongsToMany(Route::class, 'route_permission');
    }
}
