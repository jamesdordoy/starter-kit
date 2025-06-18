<?php

namespace App\Http\Middleware;

use App\Data\UserData;
use App\Settings\SiteSettings;
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

    public function __construct(
        protected SiteSettings $settings,
    ) {}

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

        $manager = app('impersonate');

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => ! is_null($user) ? UserData::from([
                    ...$user->toArray() ?? null,
                    'avatar' => $user->getFirstMediaUrl('avatars') ?? null,
                ]) : null,
                'can' => ! is_null($user) ? $user->loadMissing('roles.permissions')->roles
                    ->flatMap(fn ($role) => $role->permissions)
                    ->map(fn ($permission) => [$permission->name => $user->can($permission->name)])
                    ->collapse()
                    ->all() : [],
                'impersonator' => $manager->isImpersonating() ? UserData::from($manager->getImpersonator()) : null,
            ],
            'ziggy' => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'settings' => [
                ...$this->settings->toArray(),
                'max_file_size' => config('media-library.max_file_size'),
            ],
        ];
    }
}
