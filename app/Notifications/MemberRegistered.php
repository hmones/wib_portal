<?php

namespace App\Notifications;

use App\Mail\MemberRegistered as Mailable;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class MemberRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return $notifiable->notify_user ? ['mail']:[];
    }

    public function toMail($notifiable)
    {
        return (new Mailable($this->user, $notifiable))->to($notifiable->email);
    }

}
