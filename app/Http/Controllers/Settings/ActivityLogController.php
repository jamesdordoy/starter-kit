<?php

namespace App\Http\Controllers\Settings;

use App\Data\ActivityData;
use App\Data\Pages\Settings\Activity\Filters\ActivityFilters;
use App\Data\UserData;
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
            ->paginate($request->integer('per_page', 15))
            ->withQueryString();

        $users = User::has('activities')->select('id', 'name')->get();

        return Inertia::render('settings/activity/Index', [
            ActivityData::COLLECTION_NAME => ActivityData::collect($activities),
            UserData::COLLECTION_NAME => UserData::collect($users),
            QueryBuilderParams::PROPERTY_NAME => QueryBuilderParams::from([
                ActivityFilters::DATA_NAME => ActivityFilters::from()->toArray(),
            ]),
        ]);
    }

    public function show(Activity $activity)
    {
        return Inertia::render('settings/activity/Show', [
            ActivityData::DATA_NAME => ActivityData::from($activity->load('causer')),
        ]);
    }
}
