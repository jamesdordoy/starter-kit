<?php

namespace App\QueryBuilder\Queries;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserQuery extends QueryBuilder
{
    protected array $includes = [];

    public function __construct(?Request $request = null)
    {
        $builder = resolve(User::class)->query();

        parent::__construct($builder, $request);

        $this->allowedFilters([
            'id',
            'name',
            'email',
            AllowedFilter::scope('search'),
            'created_at',
            'updated_at',
        ])
            ->allowedIncludes($this->includes)
            ->allowedSorts([
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
            ]);
    }
}
