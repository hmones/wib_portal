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
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

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
