<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileStorage
{
    protected $web_path, $dir_path;

    public function __construct($dir_path = "/wib_uploads/profile_pictures/300x300/")
    {
        $this->web_path = config('filesystems.disks.s3.url');
        $this->dir_path = $dir_path;
    }

    public function store(UploadedFile $file): string
    {
        $extension = $file->extension();
        $filename = uniqid() . '.' . $extension;
        $normal = Image::make($file)->fit(300, 300)->encode($extension);
        $storage_path = $this->dir_path . $filename;
        Storage::disk('s3')->put($storage_path, (string)$normal, 'public');

        return $this->web_path . $storage_path;
    }

    public function destroy($url): bool
    {
        $file_path = str_replace($this->web_path, '', $url);

        return $file_path ? Storage::delete($file_path) : false;

    }
}
