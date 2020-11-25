<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Cache, Redirect,Session};

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
        $data = $request->validate([
            "name" => "required|string|unique:App\Models\Sector,name",
            "icon" => "required|string"
        ]);
        
        Sector::create($data);

        Cache::forget('sectors');
        Cache::rememberForever('sectors',function(){
            return Sector::all();
        });
        
        $request->session()->flash('success', 'Sector was saved successfully!');

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
