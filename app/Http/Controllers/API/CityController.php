<?php

namespace App\Http\Controllers\API;

use App\City;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $country_id
     * @return array (cities matching the country id)
     */
    public function index($country_id = 0)
    {
        if($country_id != 0){
            $cities = City::where('country_id', $country_id)->get();
            $response = array();
            foreach ($cities as $city)
            {
                $title = $city->name . ', ' . $city->state;
                array_push($response, array('title'=> $title));
            }
            return $response;
        }else{
            return City::all();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        //
    }
}
