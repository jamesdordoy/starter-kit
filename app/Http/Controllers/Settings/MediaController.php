<?php

namespace App\Http\Controllers\Settings;

use App\Data\MediaData;
use App\Http\Requests\Settings\Media\StoreRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use App\Models\User;
use App\QueryBuilder\Queries\MediaQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class MediaController
{
    public function index(Request $request)
    {
        $assets = (new MediaQuery($request))
            ->paginate($request->input('per_page', 8))
            ->withQueryString()
            ->appends(request()->query());

        return Inertia::render('settings/assets/Index', [
            MediaData::COLLECTION_NAME => MediaResource::collection($assets),
            'params' => $request->only(['filter']),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $user = $request->user();

        $files = collect($request->file('files'), [])
            ->map(fn ($file) => $user->addMedia($file->getRealPath())
                ->withCustomProperties([
                    'client_name' => $file->getClientOriginalName(),
                    ...['user_id' => $user->id],
                ])
                ->toMediaCollection());

        return redirect()->back();
    }

    public function show(Media $mediaItem)
    {
        $path = $mediaItem->getPath(); // This should return a real file path

        if (! \Illuminate\Support\Facades\File::exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="'.$mediaItem->file_name.'"',
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
