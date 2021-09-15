<?php

namespace App\Http\Controllers;

use App\Http\Requests\B2bApplicationStoreRequest;
use App\Models\B2bApplication;
use App\Models\Link;
use App\Models\Round;
use App\Models\SupportedLink;
use App\Models\User;
use Illuminate\Support\Arr;

class B2bApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['web', 'auth', 'verified'])->only(['index', 'store', 'create']);
    }

    public function index(Round $round)
    {
        if($round->status !== Round::CLOSED) {
            $route = route('home');
            $message = 'The B2B round is currently not open for applications';

            if ($round->status === Round::OPEN) {
                $route = route('rounds.service-providers.create', $round);
                $message = null;
            }

            return redirect($route)->with('success', $message);
        }

        $providers = $round->applications()->where('type', 'provider')->get();

        return view('applications.index', compact('providers'));
    }

    public function create(Round $round)
    {
        if ($round->applications()->where('user_id', auth()->id())->count()) {

            return redirect(route('home'))->with('success', 'An application has been submitted for the same user!');
        }

        $links = SupportedLink::limit(5)->get();

        return $round->status !== Round::OPEN
            ? redirect(route('rounds.service-providers.index', $round))
            : view('applications.create', compact('links'));
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

        B2bApplication::create(array_merge(Arr::except($data, 'user'), [
            'round_id' => $round->id,
            'user_id'  => $user->id
        ]));

        return redirect(route('home'))->with(
            'success',
            'Your application has been submitted successfully, you will hear back from us soon!'
        );
    }
}
