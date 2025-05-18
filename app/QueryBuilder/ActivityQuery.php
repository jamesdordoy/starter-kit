<?php

namespace App\QueryBuilder\Queries;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ActivityQuery extends QueryBuilder
{
    protected array $includes = [];

    public function __construct(?Request $request = null)
    {
        $builder = resolve(Activity::class)->query();

        parent::__construct($builder, $request);

        $this->allowedFilters([
            'id',
            'log_name',
            'description',
            'subject_type',
            'subject_id',
            'causer_type',
            'causer_id',
            AllowedFilter::scope('search'),
            'created_at',
            'updated_at',
        ])
            ->allowedIncludes($this->includes)
            ->allowedSorts([
                'id',
                'log_name',
                'description',
                'subject_type',
                'subject_id',
                'causer_type',
                'causer_id',
                'created_at',
                'updated_at',
            ]);
    }
}
