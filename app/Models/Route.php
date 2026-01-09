<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission;

final class Route extends Model
{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'route_permission');
    }
}
