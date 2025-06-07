<?php

namespace App\Http\Controllers\Settings;

use App\Data\MediaData;
use App\Http\Requests\Settings\Media\StoreRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use App\Models\User;
use App\QueryBuilder\Data\QueryBuilderParams;
use App\QueryBuilder\Queries\MediaQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            QueryBuilderParams::PROPERTY_NAME => QueryBuilderParams::from([
                'filter' => [
                    'search' => null,
                ],
            ]),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $user = $request->user();

        collect($request->file('files'), [])
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
        return response()->download($mediaItem->getPath(), $mediaItem->custom_properties['client_name'] ?? $mediaItem->file_name);
    }

    public function update(Request $request)
    {
        dd('hit');
    }
}
