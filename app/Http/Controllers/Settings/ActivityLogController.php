<?php

namespace App\Http\Controllers\Settings;

use App\Data\UserData;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\UserResource;
use App\Models\User;
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

        $users = User::has('activities')->get();

        return Inertia::render('settings/ActivityLog', [
            'activities' => ActivityResource::collection($activities),
            UserData::COLLECTION_NAME => UserResource::collection($users),
            'filters' => $request->only(['filter']),
        ]);
    }
}
