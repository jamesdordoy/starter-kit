<?php

namespace App\Http\Controllers\Settings;

use App\Data\ActivityData;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\QueryBuilder\Queries\ActivityQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActivityLogController
{
    public function __construct()
    {
        // $this->middleware('permission:' . PermissionEnum::VIEW_ACTIVITY_LOG->value);
    }

    public function index(Request $request)
    {
        $activities = (new ActivityQuery($request))
            ->withRelations()
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('settings/ActivityLog', [
            'activities' => ActivityResource::collection($activities),
            'filters' => $request->only(['log_name', 'causer_id', 'date', 'date_from', 'date_to', 'search']),
        ]);
    }
} 