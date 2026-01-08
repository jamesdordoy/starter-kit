<?php

namespace App\Http\Controllers\Settings;

use App\Data\MediaData;
use App\Http\Requests\Settings\Media\StoreRequest;
use App\Models\Media;
use App\QueryBuilder\Data\QueryBuilderParams;
use App\QueryBuilder\Queries\MediaQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MediaController
{
    public function index(Request $request)
    {
        $assets = (new MediaQuery($request))
            ->paginate($request->integer('per_page', 8))
            ->withQueryString();

        return Inertia::render('settings/assets/Index', [
            MediaData::COLLECTION_NAME => MediaData::collect($assets),
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
        $file = $request->file('file', null);

        if (! is_null($file)) {
            $user->addMedia($file->getRealPath())
                ->usingFileName($file->getClientOriginalName())
                ->toMediaCollection();
        }

        collect($request->file('files'), [])
            ->map(fn ($file) => $user->addMedia($file->getRealPath())
                ->usingFileName($file->getClientOriginalName())
                ->toMediaCollection());

        return redirect()->back();
    }

    public function show(Media $mediaItem)
    {
        return response()->download($mediaItem->getPath(), $mediaItem->file_name);
    }

    public function update(Request $request)
    {
        dd('hit');
    }

    public function destroy(\App\Http\Requests\Settings\Media\DeleteDefaultAssetRequest $request, Media $mediaItem)
    {
        $mediaItem->delete();

        return redirect()->back();
    }
}
