<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[
    MapName(SnakeCaseMapper::class)
]
class RoleStoreData extends Data
{
    public function __construct(
        public string $name,
        public ?string $guardName = null,
        public ?array $permissions = null,
    ) {}
}
