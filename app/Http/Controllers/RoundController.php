<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoundStore;
use App\Models\Round;

class RoundController extends Controller
{
    protected const INDEX_ROUTE = 'admin.rounds.index';

    public function index()
    {
        $rounds = Round::latest()->paginate(15);

        return view(self::INDEX_ROUTE, compact('rounds'));
    }

    public function create()
    {
        return view('admin.rounds.create');
    }

    public function store(RoundStore $request)
    {
        Round::create($request->safe()->toArray());

        return redirect(route(self::INDEX_ROUTE))->with(['success' => 'The round is saved successfully!']);
    }

    public function show(Round $round)
    {
        return view('admin.rounds.show', compact('round'));
    }

    public function edit(Round $round)
    {
        return view('admin.rounds.create', compact('round'));
    }

    public function update(RoundStore $request, Round $round)
    {
        $round->update($request->safe()->toArray());

        return redirect(route(self::INDEX_ROUTE))->with(['success' => 'The round is updated successfully!']);
    }

    public function destroy(Round $round)
    {
        $round->delete();

        return redirect(route(self::INDEX_ROUTE))->with(['success' => 'The round is deleted successfully!']);
    }
}
