<?php

namespace App\Filesystem;

use League\Flysystem\Config;
use League\Flysystem\FileAttributes;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\UnableToCopyFile;
use League\Flysystem\UnableToDeleteFile;
use League\Flysystem\UnableToMoveFile;
use League\Flysystem\UnableToReadFile;
use League\Flysystem\UnableToWriteFile;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
use Illuminate\Support\Facades\Http;

class SupabaseAdapter implements FilesystemAdapter, PublicUrlGenerator
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly string $key,
        private readonly string $bucket,
    ) {}

    public function write(string $path, string $contents, Config $config): void
    {
        $mimeType = $config->get('mimetype', $this->guessMimeType($path));

        $response = Http::withToken($this->key)
            ->withHeaders(['x-upsert' => 'true'])
            ->withBody($contents, $mimeType)
            ->post("{$this->baseUrl}/storage/v1/object/{$this->bucket}/{$path}");

        if ($response->failed()) {
            throw UnableToWriteFile::atLocation($path, $response->body());
        }
    }

    public function writeStream(string $path, $contents, Config $config): void
    {
        $this->write($path, stream_get_contents($contents), $config);
    }

    public function read(string $path): string
    {
        $response = Http::withToken($this->key)
            ->get("{$this->baseUrl}/storage/v1/object/{$this->bucket}/{$path}");

        if ($response->failed()) {
            throw UnableToReadFile::fromLocation($path, $response->body());
        }

        return $response->body();
    }

    public function readStream(string $path)
    {
        $content = $this->read($path);
        $stream  = fopen('php://temp', 'r+');
        fwrite($stream, $content);
        rewind($stream);
        return $stream;
    }

    public function delete(string $path): void
    {
        $response = Http::withToken($this->key)
            ->withBody(json_encode(['prefixes' => [$path]]), 'application/json')
            ->delete("{$this->baseUrl}/storage/v1/object/{$this->bucket}");

        if ($response->failed() && $response->status() !== 404) {
            throw UnableToDeleteFile::atLocation($path, $response->body());
        }
    }

    public function deleteDirectory(string $path): void
    {
        // no-op
    }

    public function createDirectory(string $path, Config $config): void
    {
        // Supabase Storage uses virtual paths — no explicit directory creation needed
    }

    public function setVisibility(string $path, string $visibility): void
    {
        // Visibility is managed at bucket level
    }

    public function visibility(string $path): FileAttributes
    {
        return new FileAttributes($path, null, 'public');
    }

    public function mimeType(string $path): FileAttributes
    {
        return new FileAttributes($path, null, null, null, $this->guessMimeType($path));
    }

    public function lastModified(string $path): FileAttributes
    {
        return new FileAttributes($path, null, null, time());
    }

    public function fileSize(string $path): FileAttributes
    {
        return new FileAttributes($path, 0);
    }

    public function listContents(string $path, bool $deep): iterable
    {
        return [];
    }

    public function move(string $source, string $destination, Config $config): void
    {
        $response = Http::withToken($this->key)
            ->post("{$this->baseUrl}/storage/v1/object/move", [
                'bucketId'       => $this->bucket,
                'sourceKey'      => $source,
                'destinationKey' => $destination,
            ]);

        if ($response->failed()) {
            throw UnableToMoveFile::fromLocationTo($source, $destination);
        }
    }

    public function copy(string $source, string $destination, Config $config): void
    {
        $response = Http::withToken($this->key)
            ->post("{$this->baseUrl}/storage/v1/object/copy", [
                'bucketId'       => $this->bucket,
                'sourceKey'      => $source,
                'destinationKey' => $destination,
            ]);

        if ($response->failed()) {
            throw UnableToCopyFile::fromLocationTo($source, $destination);
        }
    }

    public function fileExists(string $path): bool
    {
        $response = Http::withToken($this->key)
            ->get("{$this->baseUrl}/storage/v1/object/info/{$this->bucket}/{$path}");

        return $response->successful();
    }

    public function directoryExists(string $path): bool
    {
        return false;
    }

    public function publicUrl(string $path, Config $config): string
    {
        return "{$this->baseUrl}/storage/v1/object/public/{$this->bucket}/{$path}";
    }

    private function guessMimeType(string $path): string
    {
        return match (strtolower(pathinfo($path, PATHINFO_EXTENSION))) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png'         => 'image/png',
            'gif'         => 'image/gif',
            'webp'        => 'image/webp',
            'svg'         => 'image/svg+xml',
            'pdf'         => 'application/pdf',
            default       => 'application/octet-stream',
        };
    }
}
