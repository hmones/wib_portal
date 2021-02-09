<?php

namespace App\Notifications;

use App\Mail\CommentPublished as CommentEmail;
use App\Models\{Comment, Post};
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class CommentPublished extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post, $comment;

    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        $unreadNotifications = $this->post->user
            ->unreadnotifications
            ->where('type', 'App\Notifications\CommentPublished')
            ->where('data.post_id', $this->post->id)
            ->count();

        if (($this->post->user->id !== $this->comment->user->id) && ($unreadNotifications === 0)) {
            return $notifiable->notify_comment ? ['database', 'mail'] : ['database'];
        }

        return [];
    }

    public function toMail($notifiable)
    {
        return (new CommentEmail($this->post, $this->comment))->to($notifiable->email);
    }

    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'comment_author' => $this->comment->user->name,
            'comment_author_img' => $this->comment->user->image,
            'comment_date' => $this->comment->created_at
        ];
    }
}
