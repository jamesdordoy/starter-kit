<?php

namespace App\Http\Controllers;

use App\Data\ActivityData;
use App\Http\Resources\ActivityResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController
{
    public function __construct()
    {
        // $this->middleware('permission:' . PermissionEnum::VIEW_ACTIVITY_LOG->value);
    }

    public function index(Request $request)
    {
        $query = Activity::query()
            ->with('causer')
            ->latest();

        if ($request->filled('log_name')) {
            $query->where('log_name', $request->log_name);
        }

        if ($request->filled('causer_id')) {
            $query->where('causer_id', $request->causer_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $activities = $query->paginate(10)
            ->withQueryString();

        return Inertia::render('settings/ActivityLog', [
            'activities' => ActivityResource::collection($activities),
            'filters' => $request->only(['log_name', 'causer_id', 'date']),
        ]);
    }
} 