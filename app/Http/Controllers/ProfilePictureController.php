<?php

namespace App\Http\Controllers;

use App\Models\ProfilePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfilePictureController extends Controller
{

    const PATH_180 = "wib_uploads/profile_pictures/180x180/";
    const PATH_300 = "wib_uploads/profile_pictures/300x300/";
    const PATH_ORIGINAL = 'wib_uploads/profile_pictures/original/';

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'new_pp' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
            'old_pp' => 'nullable|string'
        ]);

        if ($validation['old_pp'] != null) {
            $this->destroy($validation['old_pp']);
        }

        $picture = $validation['new_pp'];
        $extension = $picture->extension();
        $filename = uniqid().'.'.$extension;

        $normal = Image::make($picture)->fit(180, 180)->encode($extension);
        $storage_path = self::PATH_180 . $filename;
        Storage::disk('s3')->put($storage_path, (string)$normal, 'public');

        $thumbnail = ProfilePicture::firstOrNew(
            ['filename' => $filename],
            [
                'url' => Storage::url($storage_path),
                'filename' => $filename,
                'resolution' => "180"
            ]
        );

        if (!isset($thumbnail->id)) {
            $thumbnail->save();

            $medium = Image::make($picture)->fit(300, 300)->encode($extension);
            $storage_path_m = self::PATH_300 . $filename;
            Storage::disk('s3')->put($storage_path_m, (string)$medium, 'public');

            $medium = ProfilePicture::create([
                'url' => Storage::url($storage_path_m),
                'filename' => $filename,
                'resolution' => "300"
            ]);

            $large = Image::make($picture)->encode($extension);
            $storage_path_o = self::PATH_ORIGINAL . $filename;
            Storage::disk('s3')->put($storage_path_o, (string)$large, 'public');

            $original = ProfilePicture::create([
                'url' => Storage::url($storage_path_o),
                'filename' => $filename,
                'resolution' => "original"
            ]);
        }

        return $thumbnail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */
    public static function destroy($id)
    {
        $image = ProfilePicture::findOrFail($id);
        Storage::disk('s3')->delete([
            self::PATH_180 . $image->filename,
            self::PATH_ORIGINAL . $image->filename,
            self::PATH_300 . $image->filename,
        ]);
        ProfilePicture::where('filename', $image->filename)->delete();

        return 'Pictures were deleted successfully';
    }

    /**
     * Remove empty  resources from storage and database.
     *
     * @return string
     */
    public static function destroyEmpty()
    {
        $images = ProfilePicture::unused();
        foreach($images->get() as $image)
        {
            Storage::disk('s3')->delete([
                Self::PATH_180 . $image->filename,
                Self::PATH_ORIGINAL . $image->filename,
                Self::PATH_300 . $image->filename,
            ]);
        }
        $images->delete();

        return 'Pictures were deleted successfully';
    }
}
