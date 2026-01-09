<?php

declare(strict_types=1);

namespace App\QueryBuilder\Queries;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class UserQuery extends QueryBuilder
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
            AllowedFilter::scope('roles'),
            'created_at',
            'updated_at',
        ])
            ->allowedIncludes($this->includes)
            ->allowedSorts([
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ]);
    }
}
