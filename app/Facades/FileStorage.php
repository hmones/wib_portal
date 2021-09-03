<?php

namespace App\Facades;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string store(UploadedFile $file, int $width = 300, int $height = 300)
 * @method static bool destroy(string $url)
 */
class FileStorage extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'FileStorage';
    }
}
