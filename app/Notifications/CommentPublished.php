<?php

namespace App\Notifications;

use App\Mail\CommentPublished as CommentEmail;
use App\Models\{Post,Comment};
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class CommentPublished extends Notification implements ShouldQueue
{
    use Queueable;
    
    protected $post, $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $channels = [];
        $unreadNotifications = $this->post->user
                                    ->unreadnotifications
                                    ->where('type','App\Notifications\CommentPublished')
                                    ->where('data.post_id',$this->post->id)
                                    ->count();
        if(($this->post->user->id != $this->comment->user->id) && ($unreadNotifications == 0)){
            array_push($channels, 'database');
            if($notifiable->notify_comment){
                array_push($channels, 'mail');
            }
        }
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return CommentEmail
     */
    public function toMail($notifiable)
    {
        return (new CommentEmail($this->post, $this->comment))->to($notifiable->email);
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'comment_author' => $this->comment->user->name,
            'comment_date' => $this->comment->created_at
        ];
    }
}
