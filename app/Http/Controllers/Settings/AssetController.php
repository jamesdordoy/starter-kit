<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Support\Facades\Auth;
use App\Data\ActivityData;
use App\Data\UserData;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\QueryBuilder\Queries\ActivityQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;


class AssetController
{

    public function index(Request $request)
    {
        $activities = (new ActivityQuery($request))
            ->withRelations()
            ->paginate($request->input('per_page', 15))
            ->withQueryString()
            ->appends(request()->query());


        return Inertia::render('settings/assets/Index', [
            ActivityData::COLLECTION_NAME => ActivityResource::collection($activities),
            'params' => $request->only(['filter']),
        ]);
    }

    public function update(Request $request)
    {
        // dd('hit');
        // $request->validate([
        //     'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // $user = Auth::user();

        // $user->addMediaFromRequest('avatar')
        //     ->toMediaCollection('avatars');

        // return back()->with('status', 'profile-updated');
    }
}
