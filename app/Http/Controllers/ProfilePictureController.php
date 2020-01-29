<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\ProfilePicture;

class ProfilePictureController extends Controller
{
    
    const PATH_180 = "wib_uploads/profile_pictures/180x180/";

    const PATH_ORIGINAL = 'wib_uploads/profile_pictures/original/';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'new_pp' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
            'old_pp' => 'nullable|string'
        ]);

        if($validation['old_pp'] != null)
        {
            $this->destroy($validation['old_pp']);
        }

        $picture = $validation['new_pp'];
        $extension = $picture->extension();
        $filename = $picture->hashName();

        $normal = Image::make($picture)->resize(180, 180)->encode($extension);
        $storage_path = Self::PATH_180.$filename;
        Storage::disk('s3')->put($storage_path, (string)$normal, 'public');

        $thumbnail = ProfilePicture::firstOrNew(
            ['filename' => $filename],
            [
                'url' => Storage::url($storage_path),
                'filename' => $filename,
                'resolution' => "180"
            ]
        );

        if(!isset($thumbnail->id))
        {
            $thumbnail->save();
            $large = Image::make($picture)->encode($extension);
            $storage_path_o = Self::PATH_ORIGINAL.$filename;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = ProfilePicture::findOrFail($id);
        Storage::disk('s3')->delete([
            Self::PATH_180 . $image->filename ,
            Self::PATH_ORIGINAL . $image->filename ,
        ]);
        ProfilePicture::where('filename', $image->filename)->delete();

        return 'Pictures were deleted successfully';
    }
}
