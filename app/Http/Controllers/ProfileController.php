<?php

namespace App\Http\Controllers;

use App\Models\{City, Entity, Sector, SupportedLink, User};
use App\Http\Requests\{StoreUser, UpdateUser};
use App\Jobs\{NewMemberNotification,SendContactEmail};
use App\Notifications\MemberRegistered;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Auth, Redirect, Session};
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Repositories\FileStorage;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    private $activities = array('Export', 'Import', 'Production', 'Services', 'Trade');
    private $education = array('Highschool', 'Bachelor', 'Master', 'Doctorate');
    private $associations = array('ABWA', 'BWE21', 'CNFCE', 'EBRD', 'LLWB', 'SEVE');
    const PATH_300 = "wib_uploads/profile_pictures/300x300/";

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $users = User::with('sectors:id,name', 'country')->filter($request)->paginate(20);
        
        return view('profile.index', compact(['users', 'request']));
        
    }

    /**
     * Display a listing of the resource via api.
     *
     * @return View
     */
    public function indexApi(Request $request)
    {
        $users = User::with('sectors:id,name', 'country')->filter($request)->paginate(20);
        return view('partials.profile.list', compact(['users', 'request']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $cities = [];
        $supported_links = SupportedLink::all();
        return view('profile.create', [
            'activities' => $this->activities,
            'education' => $this->education,
            'cities' => $cities,
            'supported_links' => $supported_links,
            'associations' => $this->associations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUser $request, FileStorage $storage)
    {
        $data = $request->validated();

        $data['user']['password'] = Hash::make($request->user['password']); 

        if($request->file('user.image')){
            $data['user']['image'] = $storage->store($data['user']['image']);
        }
        
        $user = User::create($data['user']);

        $sectors = $data['sectors'];
        $user->sectors()->attach($sectors);

        if(isset($data['links'])){
            $user->links()->createMany($data['links']);
        }

        $related_users = User::whereHas('sectors', function(Builder $query) use ($sectors){
            $query->whereIn('id', $sectors);
        })->where('notify_user', 1)->get();
        
        $related_users->each(function($related_user) use ($user){
            $related_user->notify(new MemberRegistered($user));
        });

        $request->session()->flash('success', 'User was created successfully!');

        return response()->redirectTo('/login');    
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $profile
     * @return View
     */
    public function show($profile)
    {
        $user = User::with('sectors:name,icon', 'country', 'entities')->findOrFail($profile);

        $association = false;
        if (isset($user->business_association_wom)){
            $association = Entity::where('name', $user->business_association_wom)->first();
        }

        return view('profile.show', [
            'user' => $user,
            'association' => $association
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $profile
     * @return View|\Illuminate\Routing\Redirector
     */
    public function edit(User $profile)
    {
        $supported_links = SupportedLink::all();
        return view('profile.edit', [
            'user' => $profile,
            'activities' => $this->activities,
            'education' => $this->education,
            'supported_links' => $supported_links,
            'associations' => $this->associations,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateUser $request, User $profile, FileStorage $storage)
    {

        $data = $request->validated();
               
        if($request->file('user.image')){
            $storage->destroy($profile->image);
            $data['user']['image'] = $storage->store($data['user']['image']);
        }

        $profile->update($data['user']);

        $profile->sectors()->detach();
        $profile->links()->delete();

        $profile->sectors()->attach($data['sectors']);

        if(isset($data['links'])){
            $profile->links()->createMany($data['links']);
        }

        $request->session()->flash('success', 'Your data was updated successfully!');
        return response()->redirectTo('/profile/'.$profile->id.'/edit');
    }

    /**
     * Contact the specified resource via email.
     *
     * @param \App\User $profile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contact(User $profile)
    {
        $auth_user = Auth::user();

        SendContactEmail::dispatch($profile, $auth_user);

        Session::flash('success', "The user has been contacted successfully!");
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $profile
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $profile, FileStorage $storage)
    {
        if ($profile->links()->exists()) {
            $profile->links()->delete();
        }
        if ($profile->sectors()->exists()) {
            $profile->sectors()->detach();
        }
        $storage->destroy($profile->image);
        Entity::ownedby(Auth::id())->update(['owned_by' => null]);
        $profile->entities()->detach();
        $profile->delete();
        Session::flash('success', $profile->name . ' has been successfully removed from the platform');
        
        return \redirect(route('profile.show', ['profile' => Auth::user()]));
    }

    public function destroyAdmin(User $profile)
    {
        if ($profile->links()->exists()) {
            $profile->links()->delete();
        }
        if ($profile->sectors()->exists()) {
            $profile->sectors()->detach();
        }
        Entity::ownedby(Auth::id())->update(['owned_by' => null]);
        $profile->entities()->detach();
        $profile->delete();
        Session::flash('success', $profile->name . ' has been successfully removed from the platform');

        return Redirect::back();
    }

    public function verify(User $profile){

        $admin = Auth::id();

        if($profile->approved_at != null){
            $profile->update([
                'approved_at' => null,
                'approved_by' => $admin
            ]);
        }else{
            $profile->update([
                'approved_at' => Carbon::now(),
                'approved_by' => $admin
            ]);
        }
        $profile->save();

        Session::flash('success', 'Verification updated successfully');

        return Redirect::back();
    }

}
