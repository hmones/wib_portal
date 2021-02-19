<?php

namespace App\Http\Controllers;

use App\Models\{Entity, Post, User};
use Illuminate\Http\Request;
use Sentry;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'query' => 'required',
        ]);

        try {
            $users = User::searchForm()->searchQuery($data['query'])->size(15)->execute()->models();
            $entities = Entity::searchForm()->searchQuery($data['query'])->size(15)->execute()->models();
            $posts = Post::searchForm()->searchQuery($data['query'])->size(15)->execute()->models();
        } catch (\Throwable $exception) {
            Sentry\captureException($exception);
            $users = User::where('name', 'like', $data['query'] . '%')->limit(15)->get();
            $entities = Entity::where('name', 'like', $data['query'] . '%')->limit(15)->get();
            $posts = Post::where('content', 'like', $data['query'] . '%')->limit(15)->get();
        }

        return view('search', compact('users', 'posts', 'entities', 'data'));
    }
}
