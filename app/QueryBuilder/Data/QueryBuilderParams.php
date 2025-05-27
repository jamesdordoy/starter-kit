<?php

namespace App\QueryBuilder\Data;

use Spatie\LaravelData\Data;

class QueryBuilderParams extends Data
{
    public const PROPERTY_NAME = 'params';

    public function __construct(
        public ?string $per_page = '15',
        public ?array $filter = [
            //
        ],
        public ?string $sort = 'id',
        public ?array $include = [
            //
        ],
    ) {}
}
