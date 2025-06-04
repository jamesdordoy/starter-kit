<?php

namespace App\Data\Pages;

use App\Data\ActivityData;
use App\Data\UserData;
use App\QueryBuilder\Data\QueryBuilderParams;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[
    MapName(SnakeCaseMapper::class)
]
class ActivityLogPage extends Data
{
    public function __construct(
        #[DataCollectionOf(ActivityData::class)]
        public DataCollection $activities,

        #[Required]
        #[DataCollectionOf(UserData::class)]
        public DataCollection $users,

        #[Required]
        public QueryBuilderParams $params,
    ) {}
}
