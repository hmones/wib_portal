<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Post;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('comments.reactions','comments.user','reactions.user','user')->latest()->take(12)->get();
        $countries = Country::all();
        $sectors = Sector::all();
        return view('home', compact(['posts','countries','sectors']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAPI()
    {
        $posts = Post::with('comments.reactions','comments.user','reactions.user','user')->latest()->paginate(12);
        
        if($posts->count() > 0){
            return view('partials.posts.list', compact('posts'));
        }

        return response('Error',200);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'post_type' => 'nullable',
            'country_id' => 'nullable|exists:countries,id',
            'sector_id' => 'nullable|exists:sectors,id',
            'user_id'=> 'required|integer|size:'.Auth::id()
        ]);

        $post = Post::create($data);

        return view('partials.posts.post',compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user->id === Auth::id()){
            $post->delete();
            return response('Post Deleted Successfully', 200);
        }

        return response('You\'re not authorized to delete this post', 401);
        
    }
}
