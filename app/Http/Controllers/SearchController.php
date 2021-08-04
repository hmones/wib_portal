<?php

namespace App\Http\Controllers;

use App\Models\{Entity, Post, User};
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'query' => 'required',
        ]);

        $users = User::where('name', 'like', $data['query'] . '%')->limit(15)->get();
        $entities = Entity::where('name', 'like', $data['query'] . '%')->limit(15)->get();
        $posts = Post::where('content', 'like', $data['query'] . '%')->limit(15)->get();

        return view('search', compact('users', 'posts', 'entities', 'data'));
    }
}
