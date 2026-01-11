<?php

namespace App\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[
    MapName(SnakeCaseMapper::class)
]
class RouteData extends Data
{
    public const DATA_NAME = 'route';

    public const COLLECTION_NAME = 'routes';

    public function __construct(
        public ?int $id,
        public string $name,
        public string $uri,
        public string $method,
        public ?string $label,
        public bool $isPublic,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $createdAt,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $updatedAt,
        #[DataCollectionOf(PermissionData::class)]
        public ?DataCollection $permissions = null,
    ) {}
}
