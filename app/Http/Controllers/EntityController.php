<?php

namespace App\Http\Controllers;

use App\Http\Requests\{FilterEntity, StoreEntity, UpdateEntity};
use App\Models\{Entity, EntityType, Photo, SupportedLink};
use App\Repositories\FileStorage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect, Session};

class EntityController extends Controller
{
    private $activities = array('Export', 'Import', 'Production', 'Services', 'Trade');
    private $relations = array('Advisory Board Member', 'Board Member', 'Co-Founder', 'Co-Owner', 'Employee', 'Founder', 'Manager', 'Member', 'Owner', 'President', 'Professor', 'Student');
    private $business_options = array(
        'balance_sheet' => array('<25Mio', '25Mio-50Mio', '50Mio-100Mio', '100Mio-500Mio', '500Mio-1Bil', '1Bil-3Bil', '3Bil-5Bil', '5Bil-10Bil', '>10Bil'),
        'revenue' => array('<25K', '25K-50K', '50K-100K', '100K-500K', '500K-1Mio', '1Mio-3Mio', '3Mio-5Mio', '5Mio-10Mio', '>10Mio'),
        'entity_size' => array('1-25', '26-50', '51-100', '101-250', '>250'),
        'employees' => array('100-300', '150-200', '101-250', '250-500', '>500'),
        'business_type' => array('Start-Up', 'Scale-Up', 'Traditional Business'),
        'turn_over' => array('<25K', '25K-50K', '50K-100K', '100K-500K', '500K-1Mio', '1Mio-3Mio', '3Mio-5Mio', '5Mio-10Mio', '>10Mio'),
        'students' => array('<200', '201-500', '501-1000', '1001-5000', '5001-10000', '10001-20000', '20001-50000', '50001-100000', '>100000'),
    );

    public function index(FilterEntity $request)
    {
        $filter = $request->validated();
        $entities = Entity::with('sectors:id,name', 'primary_country')->filter($filter)->paginate(20);
        return view('entity.index', compact(['entities', 'request']));
    }

    public function indexApi(FilterEntity $request)
    {
        $filter = $request->validated();
        $entities = Entity::with('sectors:id,name', 'primary_country')->filter($filter)->paginate(20);
        return view('partials.entity.list', compact(['entities', 'request']));
    }

    public function create()
    {
        $cities = [];
        $supported_links = SupportedLink::all();
        $entity_types = EntityType::all();
        $entity = new Entity;
        return view('entity.create', [
            'activities' => $this->activities,
            'cities' => $cities,
            'supported_links' => $supported_links,
            'relations' => $this->relations,
            'entity_types' => $entity_types,
            'business_options' => $this->business_options,
            'entity' => $entity,
            'images' => [],
        ]);
    }

    public function store(StoreEntity $request, FileStorage $storage)
    {
        $data = $request->validated();

        $data['entity']['owned_by'] = Auth::id();

        if ($request->file('entity.image')) {
            $data['entity']['image'] = $storage->store($data['entity']['image']);
        }

        $entity = Entity::create($data['entity']);

        $entity->users()->attach(Auth::id(), ['relation_type' => $data['users']['relation'], 'relation_active' => 1]);

        $entity->sectors()->attach($data['sectors']);

        if (isset($data['links'])) {
            $entity->links()->createMany($data['links']);
        }


        if (isset($data['photosID'])) {
            $photos = Photo::whereIn('id', $data['photosID'])->get();
            if ($photos) {
                $entity->photos()->saveMany($photos);
            }
        }

        $request->session()->flash('success', 'Organization was added successfully!');

        return response()->redirectTo('/profile/entities');
    }

    public function show(Entity $entity, $slug)
    {
        return view('entity.show', compact('entity'));
    }

    public function edit(Entity $entity, string $slug)
    {
        $cities = [];
        $supported_links = SupportedLink::all();
        $entity_types = EntityType::all();
        $images = $entity->photos()->latest()->get();
        return view('entity.edit', [
            'activities' => $this->activities,
            'cities' => $cities,
            'supported_links' => $supported_links,
            'relations' => $this->relations,
            'entity_types' => $entity_types,
            'business_options' => $this->business_options,
            'entity' => $entity,
            'images' => $images
        ]);
    }

    public function update(UpdateEntity $request, Entity $entity, FileStorage $storage, string $slug)
    {
        $data = $request->validated();

        if ($request->file('entity.image')) {
            $storage->destroy($entity->image);
            $data['entity']['image'] = $storage->store($data['entity']['image']);
        }

        $entity->update($data['entity']);

        $entity->users()->updateExistingPivot(Auth::id(), ['relation_type' => $data['users']['relation'], 'relation_active' => 1]);

        $entity->sectors()->detach();
        $entity->sectors()->attach($data['sectors']);

        $entity->links()->delete();
        if (isset($data['links'])) {
            $entity->links()->createMany($data['links']);
        }

        if (isset($data['photosID'])) {
            $photos = Photo::whereIn('id', $data['photosID'])->get();
            if ($photos) {
                $entity->photos()->saveMany($photos);
            }
        }

        $request->session()->flash('success', 'Organization details were updated successfully!');

        return response()->redirectTo('/profile/entities');
    }

    public function destroy(Entity $entity, FileStorage $storage, string $slug)
    {
        $entity->delete();
        Session::flash('success', $entity->name . ' has been successfully removed from the platform');

        return redirect(route('profile.entities'));
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

        return redirect(route('profile.entities'));
    }

    public function disassociateEntity(Entity $entity)
    {
        if ($entity->users()->find(Auth::id()) && ($entity->owned_by != Auth::id())) {
            $entity->users()->detach(Auth::id());
            request()->session()->flash('success', 'Relation to the organization has been successfully updated!');

        } else {

            request()->session()->flash('error', 'You registered this organization under your account, you can not remove your relationship to it! Try removing the organization instead');

        }

        return redirect(route('profile.entities'));
    }

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

    public function destroyAdmin(Entity $entity, FileStorage $storage)
    {
        $entity->delete();
        Session::flash('success', $entity->name . ' has been successfully removed from the platform');

        return Redirect::back();
    }

    public function verify(Entity $entity)
    {
        $admin = Auth::id();

        if ($entity->approved_at != null) {
            $entity->update([
                'approved_at' => null,
                'approved_by' => $admin
            ]);
        } else {
            $entity->update([
                'approved_at' => Carbon::now(),
                'approved_by' => $admin
            ]);
        }
        $entity->save();

        Session::flash('success', 'Verification updated successfully');

        return Redirect::back();
    }

}
