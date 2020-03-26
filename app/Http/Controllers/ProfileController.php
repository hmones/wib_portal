<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Entity;
use App\EntityType;
use App\ProfilePicture;
use App\Sector;
use App\SupportedLink;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private $activities = array('Export', 'Import', 'Production', 'Services', 'Trade');
    private $education = array('Highschool', 'Bachelor', 'Master', 'Doctorate');
    private $associations = array('ABWA', 'BWE21', 'CNFCE', 'LLWB', 'SEVE');
    private $relations = array('Board Member / Advisory Board Member', 'Owner / Co-Owner', 'Employee / Manager', 'Founder / Co-Founder', 'Professor', 'Employee', 'Student');

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $users = User::filter($request)->paginate(12);
        $countries = Country::all();
        $sectors = Sector::all();
        return view('profile.index', compact(['users', 'countries', 'sectors', 'request']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $countries = Country::all();
        $cities = [];
        $supported_links = SupportedLink::all();
        $sectors = Sector::all();
        return view('profile.create', [
            'activities' => $this->activities,
            'education' => $this->education,
            'countries' => $countries,
            'cities' => $cities,
            'supported_links' => $supported_links,
            'associations' => $this->associations,
            'sectors' => $sectors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        request()->validate([
            "avatar_id" => "nullable|exists:profile_pictures,id",
            "title" => "required|in:Mr.,Ms.,Prof.,Dr.",
            "birth_year" => "nullable|date_format:Y",
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|between:6,25",
            "phone_country_code" => "required|digits_between:1,5",
            "phone" => "required|digits_between:4,20",
            "links[*]['url']" => "nullable|active_url",
            "links[*]['link_type']" => "nullable|exists:supported_links,id",
            "country_id" => "required|exists:countries,id",
            "city_id" => "required|exists:cities,id",
            "postal_code" => "nullable|alpha_num|between:0,50",
            "sector_1" => "required|exists:sectors,id",
            "sector_2" => "nullable|exists:sectors,id",
            "sector_3" => "nullable|exists:sectors,id",
            "business_association_wom" => "nullable|in:ABWA,BWE21,CNFCE,LLWB,SEVE,Other",
            "education" => "required|in:Highschool,Bachelor,Master,Doctorate",
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
                "business_association_wom" => $request->business_association_wom,
                "gdpr_consent" => $request->gdpr_consent,
                "newsletter" => $request->newsletter,
                "mena_diaspora" => $request->mena_diaspora,
                "education" => $request->education,
                "network" => 'wib',
                'password' => Hash::make($request->password),
                'bio' => $request->bio,
            ]
        );

        if (isset($user->id)) {
            return response()->json(['message' => 'User already exists', 'data' => $user->email]);
        }

        $user->save();

//        Saving profile pictures to the user
        if ($request->avatar_id) {
            $thumbnail = ProfilePicture::find($request->avatar_id);
            if (isset($thumbnail->id)) {
                $images = ProfilePicture::where('filename', $thumbnail->filename)->get();
                foreach ($images as $image) {
                    $user->avatar()->save($image);
                }
            }
        }

//        Removing unused and uploaded profile pictures to a user and to an entity
        ProfilePictureController::destroyEmpty();


        if ($request->sector_1 != null) {
            $user->sectors()->attach($request->sector_1);
        }
        if ($request->sector_2 != null) {
            $user->sectors()->attach($request->sector_2);
        }
        if ($request->sector_3 != null) {
            $user->sectors()->attach($request->sector_3);
        }


        foreach ($request->links as $link) {
            if ($link['url'] != null) {
                $user->links()->create(['url' => $link['url'], 'type_id' => $link['link_type']]);
            }
        }

        $user->save();


        $request->session()->flash('success', 'User was saved successfully!');

        return response()->json(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return View
     */
    public function show(User $profile)
    {
        $association = Entity::where('name', $profile->business_association_wom)->first();

        return view('profile.show', [
            'user' => $profile,
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
        if (Auth::id() != $profile->id) {
            return redirect(route('home'));
        }
        $countries = Country::all();
        $cities = City::all();
        $supported_links = SupportedLink::all();
        $sectors = Sector::all();
        return view('profile.edit', [
            'user' => $profile,
            'activities' => $this->activities,
            'education' => $this->education,
            'countries' => $countries,
            'cities' => $cities,
            'supported_links' => $supported_links,
            'associations' => $this->associations,
            'sectors' => $sectors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $profile)
    {
        if (Auth::id() != $profile->id) {
            return redirect(route('home'));
        }
        request()->validate([
            "avatar_id" => "nullable|exists:profile_pictures,id",
            "title" => "required|in:Mr.,Ms.,Prof.,Dr.",
            "birth_year" => "nullable|date_format:Y",
            "name" => "required|string",
            "phone_country_code" => "required|digits_between:1,5",
            "phone" => "required|digits_between:4,20",
            "links[*]['url']" => "nullable|active_url",
            "links[*]['link_type']" => "nullable|exists:supported_links,id",
            "country_id" => "required|exists:countries,id",
            "city_id" => "required|exists:cities,id",
            "postal_code" => "nullable|alpha_num|between:0,50",
            "sector_1" => "required|exists:sectors,id",
            "sector_2" => "nullable|exists:sectors,id",
            "sector_3" => "nullable|exists:sectors,id",
            "business_association_wom" => "nullable|in:ABWA,BWE21,CNFCE,LLWB,SEVE,Other",
            "education" => "required|in:Highschool,Bachelor,Master,Doctorate",
            "gender" => "required|in:Male,Female",
            "gdpr_consent" => "required|boolean",
            "newsletter" => "required|boolean",
            "mena_diaspora" => "required|boolean",
            "bio" => "nullable|string"
        ]);

        $profile->update(
            [
                "birth_year" => $request->birth_year,
                "name" => $request->name,
                "title" => $request->title,
                "gender" => $request->gender,
                "phone_country_code" => $request->phone_country_code,
                "phone" => $request->phone,
                "country_id" => $request->country_id,
                "city_id" => $request->city_id,
                "postal_code" => $request->postal_code,
                "business_association_wom" => $request->business_association_wom,
                "newsletter" => $request->newsletter,
                "mena_diaspora" => $request->mena_diaspora,
                "education" => $request->education,
                "network" => 'wib',
                'bio' => $request->bio,
            ]
        );

        $profile->save();

        // Saving profile pictures to the user if it doesn't exist or if it is changed
        // Checking if there is an id of an uploaded image in the form request
        if ($request->avatar_id) {
            // Checking if the id of image in the form request doesn't match with the current existing user image
            if (!$profile->avatar()->find($request->avatar_id)) {
                // Checking if the user had old images to make them not related anymore
                if ($profile->avatar()->exists()) {
                    $profile->avatar()->update([
                        'profileable_id' => null,
                        'profileable_type' => null,
                    ]);
                }
                $thumbnail = ProfilePicture::find($request->avatar_id);
                if (isset($thumbnail->id)) {
                    $images = ProfilePicture::where('filename', $thumbnail->filename)->get();
                    foreach ($images as $image) {
                        $profile->avatar()->save($image);
                    }
                }
            }
        }

        // Removing unused and uploaded profile pictures to a user and to an entity
        ProfilePictureController::destroyEmpty();

        $profile->sectors()->detach();

        if ($request->sector_1 != null) {
            $profile->sectors()->attach($request->sector_1);
        }
        if ($request->sector_2 != null) {
            $profile->sectors()->attach($request->sector_2);
        }
        if ($request->sector_3 != null) {
            $profile->sectors()->attach($request->sector_3);
        }

        foreach ($request->links as $link) {
            if ($link['url'] != null) {
                $profile->links()->updateOrCreate(
                    ['type_id' => $link['link_type']],
                    [
                        'url' => $link['url'],
                        'type_id' => $link['link_type']
                    ]
                );
            }
        }

        $profile->save();

        $request->session()->flash('success', 'Your data was updated successfully!');
        return response()->json(['message' => 'success']);
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
        Mail::send('emails.contact', ['user' => $profile, 'auth_user' => $auth_user], function ($m) use ($profile, $auth_user) {
            $m->from('noreply@womeninbusiness-mena.com', 'Women in Business Portal');
            $m->to($profile->email)
                ->bcc('haythameyd@gmail.com')
                ->replyTo($auth_user->email, $auth_user->name)
                ->subject('A new contact request!');
        });
        Session::flash('success', "The user has been contacted successfully!");
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $profile
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $profile)
    {
        if (Auth::id() === $profile->id) {
            if ($profile->avatar()->exists()) {
                ProfilePictureController::destroy($profile->avatar()->original()->id);
            }
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
        } else {
            Session::flash('error', 'You do not have permission to perform this operation!');
        }
        return \redirect(route('profile.show', ['profile' => Auth::user()]));
    }

    public function destroyAdmin(User $profile){

        if ($profile->avatar()->exists()) {
            ProfilePictureController::destroy($profile->avatar()->original()->id);
        }
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
//        dd($profile);
        Session::flash('success', 'Verification updated successfully');

        return Redirect::back();
    }

}
