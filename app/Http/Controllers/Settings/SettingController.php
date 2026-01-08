<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

final class SettingController
{
    public function index()
    {
        $logo = DB::table('media')
            ->where('collection_name', 'site_logo')
            ->first();

        $dbConnection = DB::connection();
        $database = $dbConnection->getDatabaseName();

        $disk = Storage::disk(); // default disk
        $diskFreeSpace = disk_free_space(base_path());
        $diskTotalSpace = disk_total_space(base_path());

        return inertia('settings/Index', [
            'logo' => $logo,
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
