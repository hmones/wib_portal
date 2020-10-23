<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Redirect,Session};

class SectorController extends Controller
{
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        request()->validate([
            "sector_create_name" => "required|string",
            "sector_create_icon" => "required|string"
        ]);

        $sector = Sector::firstOrNew(
            ['name' => $request->sector_create_name],
            [
                "name" => $request->sector_create_name,
                "icon" => $request->sector_create_icon,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        );

        if (isset($sector->id)) {
            $request->session()->flash('error', 'Sector already existed before!');
        }else{
            $sector->save();
            $request->session()->flash('success', 'Sector was saved successfully!');
        }

        return Redirect::route('admin.options');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Sector $sector)
    {
        request()->validate([
            "sector_update_name" => "required|string",
            "sector_update_icon" => "required|string"
        ]);

        $sector->update([
            'name' => $request->sector_update_name,
            'icon' => $request->sector_update_icon
        ]);

        $sector->save();
        $request->session()->flash('success', 'Your data was updated successfully!');

        return Redirect::route('admin.options');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Sector $sector)
    {
        $sector->delete();
        Session::flash('success', 'Sector was deleted successfully!');
        return Redirect::route('admin.options');
    }
}
