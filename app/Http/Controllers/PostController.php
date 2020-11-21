<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Sector;
use App\Models\User;
use App\Notifications\PostPublished;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('id')){
            $posts = Post::where('id',$request->get('id'))->get();
        }else{
            $posts = Post::with('comments.reactions','comments.user','reactions.user','user')->latest()->take(12)->get();
        }
        $sectors = Sector::all();
        return view('home', compact(['posts','sectors']));
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
            'post_type' => 'exclude_if:post_type,null|nullable',
            'country_id' => 'exclude_if:coutnry_id,null|nullable|exists:countries,id',
            'sector_id' => 'exclude_if:sector_id,null|nullable|exists:sectors,id',
            'user_id'=> 'required|integer|size:'.Auth::id()
        ]);

        $post = Post::create($data);

        if(isset($data['sector_id'])){
            $sector = $data['sector_id'];
            $related_users = User::whereHas('sectors', function(Builder $query) use ($sector){
                $query->where('id',$sector);
            })->where('notify_post', 1)->get();
            $related_users->each(function($related_user) use ($post){
                $related_user->notify(new PostPublished($post));
            });
        }
        
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
        $post->delete();
        return response('Post Deleted Successfully', 200);
    }
}
