<?php

namespace App\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[
    MapName(SnakeCaseMapper::class)
]
class RoleData extends Data
{
    public const DATA_NAME = 'role';

    public const COLLECTION_NAME = 'roles';

    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $guardName,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $createdAt,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $updatedAt,
    ) {}
}
