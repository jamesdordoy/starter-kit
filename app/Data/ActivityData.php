<?php

namespace App\Data;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[
    MapName(SnakeCaseMapper::class)
]
class ActivityData extends Data
{
    public const DATA_NAME = 'activity';

    public const COLLECTION_NAME = 'activities';

    public function __construct(
        public int $id,
        public string $logName,
        public string $description,
        public ?string $subjectType,
        public ?int $subjectId,
        public ?string $causerType,
        public ?int $causerId,
        public ?UserData $causer,
        public Collection $properties,
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $createdAt,
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $updatedAt,
        public ?string $formattedCreatedAt,
    ) {}
}
