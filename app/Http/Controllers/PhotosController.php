<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Entity, Photos};
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\{Auth, Storage};
use Intervention\Image\Facades\Image;

class PhotosController extends Controller
{
    const PATH_300 = "wib_uploads/photos/300x300/";
    const PATH_ORIGINAL = 'wib_uploads/photos/original/';

    public function store(Request $request)
    {
        $request->validate([
            'photos[*]' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
        ]);
        $files = $request->allFiles();
        $images = Collection::wrap($files['photos']);
        $savedImages = array();
        $images->each(function ($image) use (&$savedImages) {
            $extension = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $thumbnail = Image::make($image)->fit(300, 300)->encode($extension);
            $storage_path_thumb = self::PATH_300 . $filename;
            Storage::disk('s3')->put($storage_path_thumb, (string)$thumbnail, 'public');
            $original = Image::make($image)->encode($extension);
            $storage_path_o = self::PATH_ORIGINAL . $filename;
            Storage::disk('s3')->put($storage_path_o, (string)$original, 'public');
            $photo = Photos::create([
                'url' => Storage::url($storage_path_o),
                'thumbnail' => Storage::url($storage_path_thumb),
                'filename' => $filename
            ]);
            if($photo){
                $savedImages[] =  $photo;
            }
        });

        return $savedImages;
    }

    public function destroy(Photos $photo)
    {
        // Delete both original and thumbnail files of S3
        Storage::disk('s3')->delete([
            self::PATH_ORIGINAL . $photo->filename,
            self::PATH_300 . $photo->filename,
        ]);
        // Delete the database record that points to those files in S3
        $photo->delete();
        // Return success response
        return response('Deleted Successfully','200');
    }

    public function update(Request $request, Photos $photo)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        // Update the photo with the comment
        $photo->comment = $request->comment;
        $photo->save();
        // Return success response
        return response('Updated Successfully','200');
    }
}
