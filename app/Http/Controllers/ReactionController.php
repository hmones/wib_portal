<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'           => 'required|exists:users,id',
            'type'              => 'required|integer|size:0',
            'reactionable_type' => 'required|in:App\Models\Post,App\Models\Comment',
            'reactionable_id'   => 'required|numeric'
        ]);
        $reaction = Reaction::create($data);
        return $reaction;
    }

    public function destroy(Reaction $reaction)
    {
        $reaction->delete();
        return response('Reaction Deleted Successfully', 200);
    }
}
