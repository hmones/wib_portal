<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments.reactions', 'comments.user', 'reactions.user', 'user')->latest()->paginate(12);

        if ($posts->count() > 0) {
            return view('partials.posts.list', compact('posts'));
        }

        return response('Error', 200);
    }
}
