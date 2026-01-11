<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission as SpatiePermission;

final class Permission extends SpatiePermission
{
    public function routes(): BelongsToMany
    {
        return $this->belongsToMany(Route::class, 'route_permission');
    }
}
