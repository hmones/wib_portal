<?php

namespace App\Http\Controllers;

use App\Models\{Country, Entity, EntityType, ProfilePicture, Sector, SupportedLink, User};
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, Redirect, Session};
use Illuminate\Http\Request;
use Illuminate\View\View;
use PhpParser\Builder;
use function MongoDB\BSON\toJSON;

class EntityController extends Controller
{
    private $activities = array('Export', 'Import', 'Production', 'Services', 'Trade');
    private $relations = array('Advisory Board Member','Board Member', 'Co-Founder', 'Co-Owner', 'Employee','Founder','Manager','Member' , 'Owner', 'President', 'Professor', 'Student');
    private $business_options = array(
        'balance_sheet' => array('<25Mio', '25Mio-50Mio', '50Mio-100Mio', '100Mio-500Mio', '500Mio-1Bil', '1Bil-3Bil', '3Bil-5Bil', '5Bil-10Bil', '>10Bil'),
        'revenue' => array('<25K', '25K-50K', '50K-100K', '100K-500K', '500K-1Mio', '1Mio-3Mio', '3Mio-5Mio', '5Mio-10Mio', '>10Mio'),
        'entity_size' => array('1-25', '26-50', '51-100', '101-250', '>250'),
        'employees' => array('100-300', '150-200', '101-250', '250-500', '>500'),
        'business_type' => array('Start-Up', 'Scale-Up', 'Traditional Business'),
        'turn_over' => array('<25K', '25K-50K', '50K-100K', '100K-500K', '500K-1Mio', '1Mio-3Mio', '3Mio-5Mio', '5Mio-10Mio', '>10Mio'),
        'students' => array('<200', '201-500', '501-1000', '1001-5000', '5001-10000', '10001-20000', '20001-50000', '50001-100000', '>100000'),
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $entities = Entity::with('sectors:id,name', 'primary_country')->with(['logo'=>function($query){
            $query->where('resolution','300');
        }])->filter($request)->paginate(12);
        $sectors = Sector::all();
        return view('entity.index', compact(['entities', 'sectors', 'request']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities = [];
        $supported_links = SupportedLink::all();
        $sectors = Sector::all();
        $entity_types = EntityType::all();
        $entity = new Entity;
        return view('entity.create', [
            'activities' => $this->activities,
            'cities' => $cities,
            'supported_links' => $supported_links,
            'sectors' => $sectors,
            'relations' => $this->relations,
            'entity_types' => $entity_types,
            'business_options' => $this->business_options,
            'entity' => $entity,
            'images' => [],
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
        $this->validateInputs();

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
                "network" => 'wib',
                "owned_by" => Auth::id(),
            ]
        );

        if (isset($entity->id)) {
            return response()->json(['message' => 'Organization already exists', 'data' => $entity->name]);
        }

        $entity->save();

        $entity->users()->attach(Auth::id(), ['relation_type' => $request->relation, 'relation_active' => 1]);


        if ($request->logo) {
            $thumbnail = ProfilePicture::find($request->logo);
            if (isset($thumbnail->id)) {
                $images = ProfilePicture::where('filename', $thumbnail->filename)->get();
                foreach ($images as $image) {
                    $entity->logo()->save($image);
                }
            }

        }

        // Removing unused and uploaded profile pictures to a user and to an entity
        ProfilePictureController::destroyEmpty();

        $entity->type()->associate($request->entity_type_id);

        if ($request->sector_1 != null) {
            $entity->sectors()->attach($request->sector_1);
        }
        if ($request->sector_2 != null) {
            $entity->sectors()->attach($request->sector_2);
        }
        if ($request->sector_3 != null) {
            $entity->sectors()->attach($request->sector_3);
        }

        foreach ($request->links as $link) {
            if ($link['url'] != null) {
                $entity->links()->create(['url' => $link['url'], 'type_id' => $link['link_type']]);
            }
        }
        
        if(isset($request->photosID)){
            foreach ($request->photosID as $photoID) {
                $photo = \App\Photos::find($photoID);
                if($photo){
                    $entity->photos()->save($photo);
                }
            }
        }

        $entity->save();

        $request->session()->flash('success', 'Organization was added successfully!');

        return response()->json(['message' => 'success', 'id' => $entity->id, 'name' => $entity->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Entity $entity
     * @return \Illuminate\View\View
     */
    public function show(Entity $entity)
    {
        return view('entity.show', compact('entity'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Entity $entity
     * @return \Illuminate\Http\RedirectResponse|View
     */
    public function edit(Entity $entity)
    {
        if ((!$entity->users()->find(Auth::id())) || ($entity->owned_by != Auth::id())) {
            return redirect(route('home'));
        }
        $cities = [];
        $supported_links = SupportedLink::all();
        $sectors = Sector::all();
        $entity_types = EntityType::all();
        $images = $entity->photos()->latest()->get();
        return view('entity.edit', [
            'activities' => $this->activities,
            'cities' => $cities,
            'supported_links' => $supported_links,
            'sectors' => $sectors,
            'relations' => $this->relations,
            'entity_types' => $entity_types,
            'business_options' => $this->business_options,
            'entity' => $entity,
            'images' => $images
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Entity $entity
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Entity $entity)
    {
        $this->validateInputs();

        $entity->update(
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
                "updated_at" => Carbon::now(),
            ]
        );

        $entity->save();

        $entity->users()->updateExistingPivot(Auth::id(), ['relation_type' => $request->relation, 'relation_active' => 1]);

        // Saving profile pictures to the entity if it doesn't exist or if it is changed
        // Checking if there is an id of an uploaded image in the form request
        if ($request->logo) {
            // Checking if the id of image in the form request doesn't match with the current existing entity logo
            if (!$entity->logo()->find($request->logo)) {
                // Checking if the entity had old images to make them not related anymore
                if ($entity->logo()->exists()) {
                    $entity->logo()->update([
                        'profileable_id' => null,
                        'profileable_type' => null,
                    ]);
                }
                $thumbnail = ProfilePicture::find($request->logo);
                if (isset($thumbnail->id)) {
                    $images = ProfilePicture::where('filename', $thumbnail->filename)->get();
                    foreach ($images as $image) {
                        $entity->logo()->save($image);
                    }
                }
            }

        }

        // Removing unused and uploaded profile pictures to a user and to an entity
        ProfilePictureController::destroyEmpty();

        $entity->type()->dissociate();
        $entity->type()->associate($request->entity_type_id);

        $entity->sectors()->detach();
        if ($request->sector_1 != null) {
            $entity->sectors()->attach($request->sector_1);
        }
        if ($request->sector_2 != null) {
            $entity->sectors()->attach($request->sector_2);
        }
        if ($request->sector_3 != null) {
            $entity->sectors()->attach($request->sector_3);
        }

        foreach ($request->links as $link) {
            if ($link['url'] != null) {
                $entity->links()->updateOrCreate(
                    ['type_id' => $link['link_type']],
                    [
                        'url' => $link['url'],
                        'type_id' => $link['link_type']
                    ]
                );
            }
        }

        if(isset($request->photosID)){
            foreach ($request->photosID as $photoID) {
                $photo = \App\Photos::find($photoID);
                if($photo){
                    $entity->photos()->save($photo);
                }
            }
        }
        

        $entity->save();

        $request->session()->flash('success', 'Organization details were updated successfully!');

        return response()->json(['message' => 'success', 'id' => $entity->id, 'name' => $entity->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Entity $entity
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Entity $entity)
    {
        if (Auth::id() === $entity->owned_by) {
            if ($entity->logo()->exists()) {
                ProfilePictureController::destroy($entity->logo()->original()->id);
            }
            if ($entity->links()->exists()) {
                $entity->links()->delete();
            }
            if ($entity->sectors()->exists()) {
                $entity->sectors()->detach();
            }
            $entity->users()->detach();
            $entity->delete();
            Session::flash('success', $entity->name . ' has been successfully removed from the platform');
        } else {
            Session::flash('error', 'To remove ' . $entity->name . ' please send us an email at info@womeninbusiness-mena.com including the name of the organization you would like to remove!');
        }
        return \redirect(route('profile.entities'));
    }

    /**
     * Associate the specified entity to a particular user.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function associateEntity(Request $request)
    {
        request()->validate([
            "other_entity_name" => "required|exists:entities,id",
            "other_entity_relation" => "required|in:" . implode(',', $this->relations),
        ]);

        Auth::user()->entities()->detach($request->other_entity_name);
        Auth::user()->entities()->attach($request->other_entity_name, ['relation_type' => $request->other_entity_relation, 'relation_active' => 1]);

        $request->session()->flash('success', 'Organizations were updated successfully!');

        return \redirect(route('profile.entities'));
    }

    /**
     * Associate the specified entity to a particular user.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disassociateEntity(Entity $entity)
    {
        if ($entity->users()->find(Auth::id()) && ($entity->owned_by != Auth::id())) {
            $entity->users()->detach(Auth::id());
            request()->session()->flash('success', 'Relation to the organization has been successfully updated!');

        } else {

            request()->session()->flash('error', 'You registered this organization under your account, you can not remove your relationship to it! Try removing the organization instead');

        }

        return \redirect(route('profile.entities'));
    }

    /**
     * Display the specified resources for a particular user.
     *
     * @return \Illuminate\View\View
     */
    public function indexUser()
    {
        $user = Auth::user();
        $entities = Entity::all();
        $owned_entities = Entity::ownedby($user->id)->get();
        $other_entities = $user->entities()->where(function ($query) {
            return $query->whereNull('owned_by')
                ->orWhere('owned_by', '!=', Auth::id());
        })->get();
        return view('profile.entities', [
            'relations' => $this->relations,
            'entities' => $entities,
            'owned_entities' => $owned_entities,
            'other_entities' => $other_entities,
        ]);
    }

    /**
     * Search entities and return a list of entities that matches the search criteria .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = '%' . $request->get('query') . '%';
        $entities = Entity::where('name', 'like', $query)->orWhere('name_additional', 'like', $query)->select('name', 'id as value')->get();
        $response = array(
            'success' => true,
            'results' => $entities,
        );
        return response()->json($response);
    }

    public function destroyAdmin(Entity $entity){

        if ($entity->logo()->exists()) {
            ProfilePictureController::destroy($entity->logo()->original()->id);
        }
        if ($entity->links()->exists()) {
            $entity->links()->delete();
        }
        if ($entity->sectors()->exists()) {
            $entity->sectors()->detach();
        }
        $entity->users()->detach();
        $entity->delete();
        Session::flash('success', $entity->name . ' has been successfully removed from the platform');

        return Redirect::back();
    }

    public function verify(Entity $entity){

        $admin = Auth::id();

        if($entity->approved_at != null){
            $entity->update([
                'approved_at' => null,
                'approved_by' => $admin
            ]);
        }else{
            $entity->update([
                'approved_at' => Carbon::now(),
                'approved_by' => $admin
            ]);
        }
        $entity->save();

        Session::flash('success', 'Verification updated successfully');

        return Redirect::back();
    }

    protected function validateInputs(){
        return request()->validate([
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
            "photosID[*]"=>"nullable|exists:photos,id",
            "primary_address" => "required|string|between:0,100",
            "primary_country_id" => "required|exists:countries,id",
            "primary_city_id" => "required|exists:cities,id",
            "primary_postbox" => "nullable|alpha_num|between:0,100",
            "primary_postal_code" => "nullable|alpha_num|between:0,50",
            "secondary_address" => "nullable|string|between:0,100",
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
            "entity_size" => "nullable|in:1-25,26-50,51-100,101-250,>250",
            "employees" => "nullable|in:100-300,150-200,101-250,250-500,>500",
            "students" => "nullable|in:<200,201-500,501-1000,1001-5000,5001-10000,10001-20000,20001-50000,50001-100000,>100000",
            "turnover" => "nullable|in:<25K,25K-50K,50K-100K,100K-500K,500K-1Mio,1Mio-3Mio,3Mio-5Mio,5Mio-10Mio,>10Mio",
            "balance_sheet" => "nullable|in:<25Mio,25Mio-50Mio,50Mio-100Mio,100Mio-500Mio,500Mio-1Bil,1Bil-3Bil,3Bil-5Bil,5Bil-10Bil,>10Bil",
            "revenue" => "nullable|in:<25K,25K-50K,50K-100K,100K-500K,500K-1Mio,1Mio-3Mio,3Mio-5Mio,5Mio-10Mio,>10Mio",
        ]);
    }
}
