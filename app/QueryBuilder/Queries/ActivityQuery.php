<?php

namespace App\QueryBuilder\Queries;

use App\Models\Activity;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ActivityQuery extends QueryBuilder
{
    protected array $includes = ['causer'];

    public function __construct(?Request $request = null)
    {
        $builder = resolve(Activity::class)->query()
            ->orderBy('created_at', 'desc');

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
            AllowedFilter::scope('date'),
            AllowedFilter::scope('date_from'),
            AllowedFilter::scope('date_to'),
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

    public function withRelations(): self
    {
        return $this->with('causer');
    }
}
