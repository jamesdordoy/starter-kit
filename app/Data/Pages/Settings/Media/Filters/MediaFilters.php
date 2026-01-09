<?php

namespace App\Data\Pages\Settings\Media\Filters;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[
    MapName(SnakeCaseMapper::class)
]
class MediaFilters extends Data
{
    public const DATA_NAME = 'filter';

    public function __construct(
        public ?string $search,
    ) {}
}
