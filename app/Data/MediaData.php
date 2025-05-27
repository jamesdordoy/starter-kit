<?php

namespace App\Data;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[
    TypeScript,
    MapName(SnakeCaseMapper::class)
]
class MediaData extends Data
{
    public const DATA_NAME = 'media';

    public const COLLECTION_NAME = 'media_items';

    public function __construct(
        public int $id,
        public string $modelType,
        public int $modelId,
        public ?string $uuid,
        public string $collectionName,
        public string $name,
        public string $fileName,
        public ?string $mimeType,
        public string $disk,
        public ?string $conversionsDisk,
        public int $size,
        public array $manipulations,
        public array $customProperties,
        public array $generatedConversions,
        public array $responsiveImages,
        public ?int $orderColumn,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $createdAt,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $updatedAt,
    ) {}
}
