<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\EntityType;
use App\Sector;
use App\SupportedLink;
use App\Entity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private $activities = array('Export','Import','Production','Services','Trade');
    private $speheres = array('Politics and Society','Science and Education','Business and Innovation','Arts and Culture','Media and Journalism');
    private $education = array('Highschool','Bachelor','Master','Doctorate');
    private $associations = array('ABWA','BWE21','CNFCE','LLWB','SEVE');
    private $relations = array('Board Member / Advisory Board Member', 'Owner / Co-Owner', 'Employee / Manager', 'Founder / Co-Founder', 'Professor', 'Employee',  'Student');

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $users = User::all();
        return view('profile.index', array('users' => $users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $countries = Country::all();
        $cities = City::all();
        $supported_links = SupportedLink::all();
        $sectors = Sector::all();
        $entities = Entity::all();
        $entity_types = EntityType::all();
        $addresses = array('primary','secondary');
        $business_options = array(
            'balance_sheet' => array('<25Mio','25Mio-50Mio','50Mio-100Mio','100Mio-500Mio','500Mio-1Bil','1Bil-3Bil','3Bil-5Bil','5Bil-10Bil','>10Bil'),
            'revenue' => array('<25K','25K-50K','50K-100K','100K-500K','500K-1Mio','1Mio-3Mio','3Mio-5Mio','5Mio-10Mio','>10Mio'),
            'entity_size' => array('1-25','26-50','51-100','101-250','>250'),
            'employees' => array('100-300','150-200','101-250','250-500','>500'),
            'business_type' => array('Start-Up','Scale-Up','Traditional Business'),
            'turn_over' => array('<25K','25K-50K','50K-100K','100K-500K','500K-1Mio','1Mio-3Mio','3Mio-5Mio','5Mio-10Mio','>10Mio'),
            'students' => array('<200','201-500','501-1000','1001-5000','5001-10000','10001-20000','20001-50000','50001-100000','>100000'),
        );
        return view('profile.create', [
            'activities' => $this->activities,
            'spheres' => $this->speheres,
            'education'=> $this->education,
            'countries' => $countries,
            'cities' => $cities,
            'supported_links' => $supported_links,
            'associations' => $this->associations,
            'sectors' => $sectors,
            'relations' => $this->relations,
            'entities' => $entities,
            'entity_types' => $entity_types,
            'addresses' => $addresses,
            'business_options' => $business_options,
        ]);
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
            "avatar_url" => "nullable|active_url",
            "title" => "required|in:Mr.,Ms.,Prof.,Dr.",
            "birth_year" => "nullable|date_format:Y",
            "name" => "required|string",
            "email" => "required|email",
            "phone_country_code" => "required|digits_between:1,5",
            "phone" => "required|digits_between:4,20",
            "links[*]['url']" => "nullable|active_url",
            "links[*]['link_type']" => "nullable|exists:supported_links,id",
            "country_id" => "required|exists:countries,id",
            "city_id" => "required|exists:cities,id",
            "postal_code" => "nullable|alpha_num|between:0,50",
            "entity_1" => "nullable|exists:entities,id",
            "relation_1" => "nullable|required_with:entity_1|in:Board Member,Advisory Board Member,Owner / Co-Owner,Employee,Manager,Founder,Co-Founder,Professor,Employee,Student",
            "entity_2" => "nullable|exists:entities,id",
            "relation_2" => "nullable|required_with:entity_2|in:Board Member,Advisory Board Member,Owner / Co-Owner,Employee,Manager,Founder,Co-Founder,Professor,Employee,Student",
            "entity_3" => "nullable|exists:entities,id",
            "relation_3" => "nullable|required_with:entity_3|in:Board Member,Advisory Board Member,Owner / Co-Owner,Employee,Manager,Founder,Co-Founder,Professor,Employee,Student",
            "sector_1" => "required|exists:sectors,id",
            "sector_2" => "nullable|exists:sectors,id",
            "sector_3" => "nullable|exists:sectors,id",
            "sphere" => "required|in:Politics and Society,Science and Education,Business and Innovation,Arts and Culture,Media and Journalism",
            "activity" => "required|in:Export,Import,Production,Services,Trade",
            "business_association_wom" => "nullable|in:ABWA,BWE21,CNFCE,LLWB,SEVE",
            "education" =>"required|in:Highschool,Bachelor,Master,Doctorate",
            "gender" => "required|in:Male,Female",
            "gdpr_consent" => "required|boolean",
            "newsletter" => "required|boolean",
            "mena_diaspora" => "required|boolean",
            "bio" => "nullable|string"
        ]);

        $user = User::firstOrNew(
            ['email' => $request->email],
            [
                "birth_year" => $request->birth_year,
                "name" => $request->name,
                "title" => $request->title,
                "email" => $request->email,
                "gender" => $request->gender,
                "phone_country_code" => $request->phone_country_code,
                "phone" => $request->phone,
                "country_id" => $request->country_id,
                "city_id" => $request->city_id,
                "postal_code" => $request->postal_code,
                "sphere" => $request->sphere,
                "activity" => $request->activity,
                "business_association_wom" => $request->business_association_wom,
                "gdpr_consent" => $request->gdpr_consent,
                "newsletter" => $request->newsletter,
                "mena_diaspora" => $request->mena_diaspora,
                "education" => $request->education,
                "network" => 'wib',
                'password' => Hash::make('pjYqy8P3hD7RVuzZrsrq'),
                'bio' => $request->bio,
            ]
        );

        $user->save();

        if ($request->avatar_url)
        {
            $user->avatar()->create(['url'=>$request->avatar_url]);
        }

        if ($request->sector_1 != null){ $user->sectors()->attach($request->sector_1); }
        if ($request->sector_2 != null){ $user->sectors()->attach($request->sector_2); }
        if ($request->sector_3 != null){ $user->sectors()->attach($request->sector_3); }

        if ($request->entity_1 != null){ $user->entities()->attach($request->entity_1,['relation_type'=>$request->relation_1, 'relation_active' => 1]); }
        if ($request->entity_2 != null){ $user->entities()->attach($request->entity_2, ['relation_type'=>$request->relation_2, 'relation_active' => 1]); }
        if ($request->entity_3 != null){ $user->entities()->attach($request->entity_3, ['relation_type'=>$request->relation_3, 'relation_active' => 1]); }

        foreach ($request->links as $link)
        {
            if ($link['url'] != null)
            {
                $user->links()->create(['url'=>$link['url'],'type_id'=>$link['link_type']]);
            }
        }
        $user->save();
        return response()->json(['message'=>'success','data'=>$user , 'id'=>$user->id, 'name'=>$user->name]);    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
