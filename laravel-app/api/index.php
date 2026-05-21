<?php

define('LARAVEL_START', microtime(true));

// Vercel's filesystem is read-only; redirect writable Laravel paths to /tmp
$tmpStorage = '/tmp/storage';
foreach ([
    $tmpStorage,
    "$tmpStorage/framework",
    "$tmpStorage/framework/cache",
    "$tmpStorage/framework/cache/data",
    "$tmpStorage/framework/sessions",
    "$tmpStorage/framework/views",
    "$tmpStorage/logs",
    "$tmpStorage/app",
    "$tmpStorage/app/public",
] as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Point Laravel storage to the writable /tmp directory
$app->useStoragePath($tmpStorage);

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);
