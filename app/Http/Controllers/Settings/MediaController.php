<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Data\MediaData;
use App\Data\Pages\Settings\Media\Filters\MediaFilters;
use App\Http\Requests\Settings\Media\DeleteDefaultAssetRequest;
use App\Http\Requests\Settings\Media\StoreRequest;
use App\Models\Media;
use App\QueryBuilder\Data\QueryBuilderParams;
use App\QueryBuilder\Queries\MediaQuery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class MediaController
{
    public function index(Request $request): Response
    {
        $assets = (new MediaQuery($request))
            ->paginate($request->integer('per_page', 8))
            ->withQueryString();

        return Inertia::render('settings/assets/Index', [
            MediaData::COLLECTION_NAME => MediaData::collect($assets),
            QueryBuilderParams::PROPERTY_NAME => QueryBuilderParams::from([
                MediaFilters::DATA_NAME => MediaFilters::from()->toArray(),
            ]),
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $user = $request->user();
        $file = $request->file('file');

        if ($file !== null) {
            $user->addMedia($file->getRealPath())
                ->usingFileName($file->getClientOriginalName())
                ->toMediaCollection();
        }

        collect($request->file('files', []))
            ->each(fn ($file) => $user->addMedia($file->getRealPath())
                ->usingFileName($file->getClientOriginalName())
                ->toMediaCollection());

        return redirect()->back();
    }

    public function show(Media $mediaItem): BinaryFileResponse
    {
        $filename = $mediaItem->custom_properties['client_name'] ?? $mediaItem->file_name;

        return response()->download($mediaItem->getPath(), $filename);
    }

    public function update(Request $request): void
    {
        // TODO: Implement update functionality
    }

    public function destroy(DeleteDefaultAssetRequest $request, Media $mediaItem): RedirectResponse
    {
        $mediaItem->delete();

        return redirect()->back();
    }
}
