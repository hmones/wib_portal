<?php

namespace App\Http\Controllers;

use App\Jobs\DeletePost;
use App\Models\Post;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('id')) {
            $posts = Post::where('id', $request->get('id'))->get();
        } else {
            $posts = Post::with('comments.reactions', 'comments.user', 'reactions.user', 'user')->latest()->take(12)->get();
        }
        $sectors = Sector::all();
        return view('home', compact(['posts', 'sectors']));
    }

    public function indexAPI()
    {
        $posts = Post::with('comments.reactions', 'comments.user', 'reactions.user', 'user')->latest()->paginate(12);

        if ($posts->count() > 0) {
            return view('partials.posts.list', compact('posts'));
        }

        return response('Error', 200);

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'post_type' => 'exclude_if:post_type,null|nullable',
            'country_id' => 'exclude_if:coutnry_id,null|nullable|exists:countries,id',
            'sector_id' => 'exclude_if:sector_id,null|nullable|exists:sectors,id',
            'user_id' => 'required|integer|size:' . Auth::id()
        ]);

        $post = Post::create($data);

        return view('partials.posts.post', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->update(['active' => 0]);
        $post->comments()->update(['active' => 0]);
        dispatch(new DeletePost($post));

        return response('Post Deleted Successfully', 200);
    }
}
