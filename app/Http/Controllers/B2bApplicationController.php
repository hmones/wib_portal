<?php

namespace App\Http\Controllers;

use App\Http\Requests\B2bApplicationStoreRequest;
use App\Models\B2bApplication;
use App\Models\Round;
use App\Models\SupportedLink;
use App\Models\User;
use App\Notifications\B2bApplicationNotification;
use Illuminate\Support\Arr;

class B2bApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['web', 'auth', 'verified'])->only(['index', 'store', 'create']);
        $this->middleware('rounds')->only(['index', 'create']);
    }

    public function index(Round $round)
    {
        if ($round->status === Round::OPEN) {
            return redirect(route('rounds.service-providers.create', $round));
        }

        $providers = $round->applications()->where('type', 'provider')
            ->where('status', B2bApplication::ACCEPTED)
            ->get();

        return view('applications.index', compact('providers'));
    }

    public function create(Round $round)
    {
        if ($round->status === Round::CLOSED) {
            return redirect(route('rounds.service-providers.index', $round));
        }

        return view('applications.create', ['links' => SupportedLink::limit(5)->get()]);
    }

    public function store(Round $round, B2bApplicationStoreRequest $request)
    {
        $data = $request->safe()->toArray();
        $user = User::findOrFail(auth()->id());
        $user->update(data_get($data, 'user'));

        if (data_get($data, 'links', false)) {
            $user->links()->delete();
            $user->links()->createMany(data_get($data, 'links'));
        }

        $application = B2bApplication::create(array_merge(Arr::except($data, 'user'), [
            'round_id' => $round->id,
            'user_id'  => $user->id,
            'status'   => B2bApplication::SUBMITTED
        ]));

        $user->notify(new B2bApplicationNotification($application));

        return redirect(route('home'))->with(
            'success',
            'Your application was submitted successfully'
        );
    }
}
