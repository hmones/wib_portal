<?php

namespace App\Mail;

use App\Models\{Post, Comment};
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentPublished extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $post, $comment;

    /**
     * Create a new message instance.
     * @param Post $post
     * @param Comment $comment
     * @return void
     */
    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Someone commented on your post')
                    ->markdown('emails.newComment')
                    ->with([
                        'post' => $this->post,
                        'path' => url('/') . '/home?id=' . $this->post->id,
                        'name' => $this->comment->user->name,
                        'image' => $this->comment->user->image
                    ]);
    }
}
