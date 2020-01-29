<?php

namespace App\Http\Controllers;

use App\Entity;
use App\ProfilePicture;
use Illuminate\Http\Request;

class EntityController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        request()->validate([
            "logo" => "nullable|exists:profile_pictures,id",
            "entity_type_id" => "required|exists:entity_types,id",
            "founding_year" => "nullable|date_format:Y",
            "name" => "required|string",
            "name_additional" => "nullable|string",
            "primary_email" => "required|email",
            "secondary_email" => "nullable|email",
            "phone_country_code" => "nullable|required_with:phone|digits_between:1,5",
            "phone" => "nullable|digits_between:4,20",
            "fax" => "nullable|digits_between:4,20",
            "links[*]['url']" => "nullable|active_url",
            "links[*]['link_type']" => "nullable|exists:supported_links,id",
            "primary_address" => "required|alpha_dash|between:0,100",
            "primary_country_id" => "required|exists:countries,id",
            "primary_city_id" => "required|exists:cities,id",
            "primary_postbox" => "nullable|alpha_num|between:0,100",
            "primary_postal_code" => "nullable|alpha_num|between:0,50",
            "secondary_address" => "nullable|alpha_dash|between:0,100",
            "secondary_country_id" => "nullable|exists:countries,id",
            "secondary_city_id" => "nullable|exists:cities,id",
            "secondary_postbox" => "nullable|alpha_num|between:0,100",
            "secondary_postal_code" => "nullable|alpha_num|between:0,50",
            "sector_1" => "required|exists:sectors,id",
            "sector_2" => "nullable|exists:sectors,id",
            "sector_3" => "nullable|exists:sectors,id",
            "legal_form" => "nullable|in:Public,Private",
            "activity" => "nullable|in:Export,Import,Production,Services,Trade",
            "business_type" => "nullable|in:Start-Up,Scale-Up,Traditional Business",
            "entity_size" =>"nullable|in:1-25,26-50,51-100,101-250,>250",
            "employees" => "nullable|in:100-300,150-200,101-250,250-500,>500",
            "students" => "nullable|in:<200,201-500,501-1000,1001-5000,5001-10000,10001-20000,20001-50000,50001-100000,>100000",
            "turnover" => "nullable|in:<25K,25K-50K,50K-100K,100K-500K,500K-1Mio,1Mio-3Mio,3Mio-5Mio,5Mio-10Mio,>10Mio",
            "balance_sheet" => "nullable|in:<25Mio,25Mio-50Mio,50Mio-100Mio,100Mio-500Mio,500Mio-1Bil,1Bil-3Bil,3Bil-5Bil,5Bil-10Bil,>10Bil",
            "revenue" => "nullable|in:<25K,25K-50K,50K-100K,100K-500K,500K-1Mio,1Mio-3Mio,3Mio-5Mio,5Mio-10Mio,>10Mio",
        ]);

        $entity = Entity::firstOrNew(
            ['name' => $request->name],
            [
                "founding_year" => $request->founding_year,
                "entity_type_id" => $request->entity_type_id,
                "name" => $request->name,
                "name_additional" => $request->name_additional,
                "primary_email" => $request->primary_email,
                "secondary_email" => $request->secondary_email,
                "phone_country_code" => $request->phone_country_code,
                "phone" => $request->phone,
                "fax" => $request->fax,
                "primary_address" => $request->primary_address,
                "primary_country_id" => $request->primary_country_id,
                "primary_city_id" => $request->primary_city_id,
                "primary_postbox" => $request->primary_postbox,
                "primary_postal_code" => $request->primary_postal_code,
                "secondary_address" => $request->secondary_address,
                "secondary_country_id" => $request->secondary_country_id,
                "secondary_city_id" => $request->secondary_city_id,
                "secondary_postbox" => $request->secondary_postbox,
                "secondary_postal_code" => $request->secondary_postal_code,
                "legal_form" => $request->legal_form,
                "activity" => $request->activity,
                "business_type" => $request->business_type,
                "entity_size" => $request->entity_size,
                "employees" => $request->employees,
                "students" => $request->students,
                "turn_over" => $request->turnover,
                "balance_sheet" => $request->balance_sheet,
                "revenue" => $request->revenue,
                "network" => 'wib'
            ]
        );

        if(isset($entity->id))
        {
            return response()->json(['message'=>'Organization already exists','data'=>$entity->name]);
        }

        $entity->save();

        if ($request->logo)
        {
            $thumbnail = ProfilePicture::find($request->logo);
            if(isset($thumbnail->id))
            {
                $images = ProfilePicture::where('filename',$thumbnail->filename)->get();
                foreach($images as $image)
                {
                    $entity->logo()->save($image);
                }
            }

        }

        $entity->type()->associate($request->entity_type_id);
        $entity->save();

        if ($request->sector_1 != null){ $entity->sectors()->attach($request->sector_1); }
        if ($request->sector_2 != null){ $entity->sectors()->attach($request->sector_2); }
        if ($request->sector_3 != null){ $entity->sectors()->attach($request->sector_3); }
        ;
        foreach ($request->links as $link)
        {
            if ($link['url'] != null)
            {
                $entity->links()->create(['url'=>$link['url'],'type_id'=>$link['link_type']]);
            }
        }
        $entity->save();
        return response()->json(['message'=>'success','data'=>$request->all(), 'id'=>$entity->id, 'name'=>$entity->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function show(Entity $entity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function edit(Entity $entity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entity $entity)
    {
        //
    }
}
