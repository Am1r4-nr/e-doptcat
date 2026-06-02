<?php

namespace App\Providers;

use App\Filesystem\SupabaseAdapter;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class SupabaseStorageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Storage::extend('supabase', function ($app, $config) {
            $adapter = new SupabaseAdapter(
                $config['url'],
                $config['key'],
                $config['bucket'],
            );

            return new FilesystemAdapter(
                new Filesystem($adapter),
                $adapter,
                $config,
            );
        });
    }
}
