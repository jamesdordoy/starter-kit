<?php

declare(strict_types=1);

namespace App\QueryBuilder\Queries;

use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

final class RoleQuery extends QueryBuilder
{
    protected array $includes = ['permissions'];

    public function __construct(?Request $request = null)
    {
        $builder = resolve(Role::class)->query()->with('permissions');

        parent::__construct($builder, $request);

        $this->allowedFilters([
            'id',
            'name',
            'guard_name',
            'created_at',
            'updated_at',
        ])
            ->allowedIncludes($this->includes)
            ->allowedSorts([
                'id',
                'name',
                'guard_name',
                'created_at',
                'updated_at',
            ]);
    }
}
