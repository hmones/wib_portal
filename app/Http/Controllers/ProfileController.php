<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Requests\{FilterUser, StoreUser, UpdateUser};
use App\Jobs\DeleteUser;
use App\Models\{Entity, SupportedLink, User};
use App\Notifications\MemberRegistered;
use App\Repositories\FileStorage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\{Hash, Redirect};

class ProfileController extends Controller
{
    private $activities = array('Export', 'Import', 'Production', 'Services', 'Trade');
    private $education = array('Highschool', 'Bachelor', 'Master', 'Doctorate');
    private $associations = array('ABWA', 'BWE21', 'CNFCE', 'EBRD', 'LLWB', 'SEVE', 'WICS', 'WICC');

    public function __construct(protected UserRepository $userRepository)
    {
        //
    }

    public function index(FilterUser $request)
    {
        $filter = $request->validated();

        $users = User::with('sectors:id,name', 'country')->filter($filter)->orderBy('image', 'desc')->paginate(20);

        return view('profile.index', compact(['users', 'request']));

    }

    public function indexApi(FilterUser $request)
    {
        $filter = $request->validated();

        $users = User::with('sectors:id,name', 'country')->filter($filter)->orderBy('image', 'desc')->paginate(20);
        return view('partials.profile.list', compact(['users', 'request']));
    }


    public function create()
    {
        $supported_links = SupportedLink::all();
        return view('profile.create', [
            'activities'      => $this->activities,
            'education'       => $this->education,
            'cities'          => [],
            'supported_links' => $supported_links,
            'associations'    => $this->associations,
        ]);
    }

    public function store(StoreUser $request, FileStorage $storage)
    {
        $data = $request->validated();

        $data['user']['password'] = Hash::make($request->user['password']);

        if ($request->file('user.image')) {
            $data['user']['image'] = $storage->store($data['user']['image']);
        }

        $data_percent = $this->userRepository->calculateCompletion(array_merge(data_get($data, 'user', []), data_get($data, 'links', [])));

        $user = User::create(array_merge($data['user'], compact('data_percent')));

        $sectors = $data['sectors'];
        $user->sectors()->attach($sectors);

        if (isset($data['links'])) {
            $user->links()->createMany($data['links']);
        }

        $related_users = User::whereHas('sectors', function (Builder $query) use ($sectors) {
            $query->whereIn('id', $sectors);
        })->where('notify_user', 1)->get();

        $related_users->each(function ($related_user) use ($user) {
            $related_user->notify(new MemberRegistered($user));
        });

        $request->session()->flash('success', 'User was created successfully!');

        return response()->redirectTo('/login');
    }

    public function show(User $profile, string $slug = null)
    {
        $profile->load('sectors:name,icon', 'country', 'entities');

        $association = false;
        if (isset($profile->business_association_wom)) {
            $association = Entity::select('name', 'name_additional', 'image', 'id')->where('name', $profile->business_association_wom)
                ->orWhere('name_additional', $profile->business_association_wom)
                ->first();
        }

        return view('profile.show', [
            'user'        => $profile,
            'association' => $association
        ]);
    }

    public function edit(User $profile, string $slug)
    {
        $supported_links = SupportedLink::all();
        return view('profile.edit', [
            'user'            => $profile,
            'activities'      => $this->activities,
            'education'       => $this->education,
            'supported_links' => $supported_links,
            'associations'    => $this->associations,
        ]);
    }

    public function update(UpdateUser $request, User $profile, FileStorage $storage, string $slug)
    {

        $data = $request->validated();

        if ($request->file('user.image')) {
            $storage->destroy($profile->image);
            $data['user']['image'] = $storage->store($data['user']['image']);
        }

        $data_percent = $this->userRepository->calculateCompletion(array_merge(data_get($data, 'user', []), data_get($data, 'links', [])));

        $profile->update(array_merge($data['user'], compact('data_percent')));

        $profile->sectors()->detach();
        $profile->links()->delete();

        $profile->sectors()->attach($data['sectors']);

        if (isset($data['links'])) {
            $profile->links()->createMany($data['links']);
        }

        dispatch(new \App\Jobs\UpdateUser($profile));
        $request->session()->flash('success', 'Your data was updated successfully!');

        return Redirect::to($profile->path . '/edit');
    }

    public function destroy(User $profile, string $slug)
    {
        $profile->update(['active' => 0]);

        dispatch(new DeleteUser($profile));

        return redirect(route('login'))->with(['success' => $profile->name . ' has been successfully removed from the platform']);
    }

    public function destroyAdmin(User $profile)
    {
        $profile->update(['active' => 0]);

        dispatch(new DeleteUser($profile));

        return back()->with(['success' => $profile->name . ' has been successfully removed from the platform']);
    }

    public function verify(User $profile)
    {
        $approved_by = auth()->guard('admin')->id();
        $approved_at = $profile->approved_at ? null : now();

        $profile->update(compact('approved_by', 'approved_at'));

        return back()->with(['success' => 'Verification updated successfully']);
    }

    protected function deleteRelatedModels(User $user): void
    {
        $user->sentMessages()->delete();
        $user->receivedMessages()->delete();
        $user->links()->delete();
        $user->owned_entities()->update(['owned_by' => null]);
        $user->sectors()->detach();
        $user->entities()->detach();
        $user->posts()->update(['active' => 0]);
        $user->comments()->update(['active' => 0]);
        $user->reactions()->update(['active' => 0]);
        $user->update(['active' => 0]);
        $user->save();
    }

}
