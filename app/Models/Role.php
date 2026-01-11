<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

#[UseFactory(RoleFactory::class)]
final class Role extends SpatieRole
{
    use HasFactory;
}
