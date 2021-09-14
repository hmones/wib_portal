<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Illuminate\Http\Request;

class B2bApplicationController extends Controller
{
    public function index(Round $round)
    {
        return $round->status !== Round::OPEN
            ? redirect(route('rounds.service-providers.create', $round))
            : response()->json($round->applications()->where('type', 'provider')->get()->toArray());
    }

    public function create(Round $round)
    {
        return $round->status !== Round::PUBLISHED
            ? redirect(route('rounds.service-providers.index', $round))
            : view('applications.create');
    }

    public function store(Round $round, Request $request)
    {
        dd($request->all());
    }
}
