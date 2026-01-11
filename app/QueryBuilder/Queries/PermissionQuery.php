<?php

declare(strict_types=1);

namespace App\QueryBuilder\Queries;

use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

final class PermissionQuery extends QueryBuilder
{
    protected array $includes = [];

    public function __construct(?Request $request = null)
    {
        $builder = resolve(Permission::class)->query();

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
