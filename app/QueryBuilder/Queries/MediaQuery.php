<?php

namespace App\QueryBuilder\Queries;

use App\Models\Media;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MediaQuery extends QueryBuilder
{
    // You can add any allowed includes here if needed, e.g. ['model']
    protected array $includes = [];

    public function __construct(?Request $request = null)
    {
        $builder = resolve(Media::class)->query()
            ->orderBy('created_at', 'desc');

        parent::__construct($builder, $request);

        $this->allowedFilters([
            'id',
            'model_type',
            'model_id',
            'uuid',
            'collection_name',
            'name',
            'file_name',
            'mime_type',
            'disk',
            'conversions_disk',
            'size',
            'order_column',
            'created_at',
            'updated_at',
        ])
        ->allowedIncludes($this->includes)
        ->allowedSorts([
            'id',
            'model_type',
            'model_id',
            'uuid',
            'collection_name',
            'name',
            'file_name',
            'mime_type',
            'disk',
            'conversions_disk',
            'size',
            'order_column',
            'created_at',
            'updated_at',
        ]);
    }

    // You can add methods for including relations if needed
}
