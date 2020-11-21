<?php

namespace App\Mail;

use App\Models\{Post, User};
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostPublished extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    protected $post, $notifiable;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $notifiable)
    {
        $this->post = $post;
        $this->notifiable = $notifiable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Someone made a post in your field')
                    ->markdown('emails.newPost')
                    ->with([
                        'post' => $this->post,
                        'notifiable' => $this->notifiable
                    ]);
    }
}
