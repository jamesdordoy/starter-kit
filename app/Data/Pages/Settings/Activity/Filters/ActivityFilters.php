<?php

namespace App\Data\Pages\Settings\Activity\Filters;

use App\Data\UserData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[
    MapName(SnakeCaseMapper::class)
]
class ActivityFilters extends Data
{
    public function __construct(
        public ?string $description,
        public ?int $causerId,
        public UserData $dateRange,

    ) {}
}
