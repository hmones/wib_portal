<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity;
use App\Photos;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotosController extends Controller
{
    const PATH_300 = "wib_uploads/photos/300x300/";
    const PATH_ORIGINAL = 'wib_uploads/photos/original/';

    public function store(Request $request, Entity $entity)
    {
        if ($entity->owned_by == Auth::id()) {
            return response()->json(['msg' => 'Unable to update photos']);
        }
        $request->validate([
            'file[*]' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
        ]);
        $files = $request->allFiles();
        $images = Collection::wrap($files['file']);
        $images->each(function ($image) use ($entity) {
            $extension = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $thumbnail = Image::make($image)->fit(300, 300)->encode($extension);
            $storage_path_thumb = self::PATH_300 . $filename;
            Storage::disk('s3')->put($storage_path_thumb, (string)$thumbnail, 'public');

            $original = Image::make($image)->encode($extension);
            $storage_path_o = self::PATH_ORIGINAL . $filename;
            Storage::disk('s3')->put($storage_path_o, (string)$original, 'public');
            $entity->photos()->create([
                'url' => Storage::url($storage_path_o),
                'thumbnail' => Storage::url($storage_path_thumb),
                'filename' => $filename
            ]);
        });
        return redirect(route('entity.edit', compact('entity')) . '#ImageUpload');
    }

    public function destroy(Request $request, Entity $entity, Photos $photo)
    {
        // Check if the user is allowed to delete those images
        // Delete both original and thumbnail files of S3
        Storage::disk('s3')->delete([
            self::PATH_ORIGINAL . $photo->filename,
            self::PATH_300 . $photo->filename,
        ]);
        // Delete the database record that points to those files in S3
        $photo->delete();
        // Redirect user to the edit page
        return redirect(route('entity.edit', compact('entity')) . '#ImageUpload');
    }
}
