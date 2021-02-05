<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteComment;
use App\Models\{Comment, Post};
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post->comments()->latest()->paginate(3);

        if ($comments->count() > 0) {
            return view('partials.comments.list', compact('comments'));
        }

        return response('Error', 200);

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required',
            'commentable_type' => 'required|in:App\Models\Post,App\Models\Comment',
            'commentable_id' => 'required|exists:posts,id'
        ]);

        $comment = Comment::create($data);

        return view('partials.comments.comment', compact('comment'));
    }

    public function destroy(Comment $comment)
    {
        $comment->update(['active' => 0]);
        dispatch(new DeleteComment($comment));

        return response('Comment Deleted Successfully', 200);
    }
}
