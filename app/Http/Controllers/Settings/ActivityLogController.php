<?php

namespace App\Http\Controllers\Settings;

use App\Data\ActivityData;
use App\Data\UserData;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\UserResource;
use App\Models\Activity;
use App\Models\User;
use App\QueryBuilder\Data\QueryBuilderParams;
use App\QueryBuilder\Queries\ActivityQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActivityLogController
{
    public function index(Request $request)
    {
        $activities = (new ActivityQuery($request))
            ->withRelations()
            ->paginate($request->input('per_page', 15))
            ->withQueryString()
            ->appends(request()->query());

        $users = User::has('activities')->get();

        return Inertia::render('settings/activity/Index', [
            ActivityData::COLLECTION_NAME => ActivityResource::collection($activities),
            UserData::COLLECTION_NAME => UserResource::collection($users),
            QueryBuilderParams::PROPERTY_NAME => QueryBuilderParams::from([
                'filter' => [
                    'description' => null,
                    'causer_id' => null,
                    'date_range' => null,
                ],
            ]),
        ]);
    }

    public function show(Activity $activity)
    {
        return Inertia::render('settings/activity/Show', [
            ActivityData::DATA_NAME => new ActivityResource($activity->load('causer')),
        ]);
    }
}
