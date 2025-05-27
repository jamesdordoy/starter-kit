<?php

namespace App\Http\Middleware;

use App\Data\UserData;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => ! is_null($user) ? UserData::from([
                    ...$user->toArray() ?? null,
                    'avatar' => $user->getFirstMediaUrl('avatars') ?? null,
                ]) : null,
                'can' => ! is_null($user) ? $user->loadMissing('roles.permissions')
                    ->roles->flatMap(function ($role) {
                        return $role->permissions;
                    })->map(function ($permission) use ($user) {
                        return [$permission->name => $user->can($permission->name)];
                    })->collapse()->all() : [],
            ],
            'ziggy' => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
        ];
    }
}
