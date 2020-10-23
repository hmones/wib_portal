<?php

namespace App\Http\Controllers;

use App\Models\EntityType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EntityTypeController extends Controller
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        request()->validate([
            "entityType_create_name" => "required|string",
            "entityType_create_icon" => "required|string"
        ]);

        $entityType = EntityType::firstOrNew(
            ['name' => $request->entityType_create_name],
            [
                "name" => $request->entityType_create_name,
                "icon" => $request->entityType_create_icon,
                "entity_size" => 1,
                "turn_over" => 1,
                "balance_sheet" => 1,
                "revenue" => 1,
                "employees" => 1,
                "students" => 1,
                "business_type" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        );

        if (isset($entityType->id)) {
            $request->session()->flash('error', 'Entity type already existed before!');
        }else{
            $entityType->save();
            $request->session()->flash('success', 'Entity type was saved successfully!');
        }

        return Redirect::route('admin.options');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EntityType  $entityType
     * @return \Illuminate\Http\Response
     */
    public function show(EntityType $entityType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EntityType  $entityType
     * @return \Illuminate\Http\Response
     */
    public function edit(EntityType $entityType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntityType  $entityType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, EntityType $entityType)
    {
        request()->validate([
            "entityType_update_name" => "required|string",
            "entityType_update_icon" => "required|string"
        ]);

        $entityType->update([
            'name' => $request->entityType_update_name,
            'icon' => $request->entityType_update_icon
        ]);

        $entityType->save();
        $request->session()->flash('success', 'Your data was updated successfully!');

        return Redirect::route('admin.options');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntityType  $entityType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(EntityType $entityType)
    {
        $entityType->delete();
        Session::flash('success', 'Entity type was deleted successfully!');
        return Redirect::route('admin.options');
    }
}
