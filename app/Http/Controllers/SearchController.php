<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Entity, Post};

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'query' => 'required',
        ]);
        
        $users = User::searchForm()->searchQuery($data['query'])->size(15)->execute()->models();
        
        $entities = Entity::searchForm()->searchQuery($data['query'])->size(15)->execute()->models();
        
        $posts = Post::searchForm()->searchQuery($data['query'])->size(15)->execute()->models();
        
        return view('search', compact('users','posts','entities', 'data'));
    }
}
