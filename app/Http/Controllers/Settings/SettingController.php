<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Models\Media;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

final class SettingController
{
    public function index(): Response
    {
        $setting = Setting::where('name', 'logo_media_id')->first();
        $logo = $setting?->getFirstMedia('site_logo');

        $dbConnection = app('db')->connection();
        $database = $dbConnection->getDatabaseName();

        $disk = Storage::disk(); // default disk
        $diskFreeSpace = disk_free_space(base_path());
        $diskTotalSpace = disk_total_space(base_path());

        return Inertia::render('settings/Index', [
            'logo' => $logo?->toArray(),
            'system' => [
                'app_name' => config('app.name'),
                'app_env' => App::environment(),
                'app_debug' => config('app.debug'),
                'laravel_version' => App::version(),
                'php_version' => PHP_VERSION,
                'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? php_sapi_name(),
                'os' => PHP_OS,
            ],
            'database' => [
                'connection' => config('database.default'),
                'driver' => $dbConnection->getDriverName(),
                'host' => config("database.connections.{$dbConnection->getDriverName()}.host"),
                'database' => $database,
            ],
            'cache' => [
                'driver' => config('cache.default'),
            ],
            'queue' => [
                'driver' => config('queue.default'),
            ],
            'storage' => [
                'default_disk' => config('filesystems.default'),
                'free_space_mb' => round($diskFreeSpace / 1024 / 1024, 2),
                'total_space_mb' => round($diskTotalSpace / 1024 / 1024, 2),
            ],
            'mail' => [
                'driver' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'username' => config('mail.mailers.smtp.username'),
                'from' => [
                    'address' => config('mail.from.address'),
                    'name' => config('mail.from.name'),
                ],
            ],
        ]);
    }

    public function create(): void
    {
        //
    }

    public function store(Request $request): void
    {
        //
    }

    public function show(string $id): void
    {
        //
    }

    public function edit(string $id): void
    {
        //
    }

    public function update(Request $request, string $id): void
    {
        //
    }

    public function destroy(string $id): void
    {
        //
    }
}
