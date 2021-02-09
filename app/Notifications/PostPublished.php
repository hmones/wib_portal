<?php

namespace App\Notifications;

use App\Mail\PostPublished as Mailable;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PostPublished extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return $notifiable->notify_post ? ['mail']:[];
    }

    public function toMail($notifiable)
    {
        return (new Mailable($this->post, $notifiable))->to($notifiable->email);
    }

}
