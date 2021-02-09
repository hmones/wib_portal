<?php

namespace App\Notifications;

use App\Mail\MessageSent as Mailable;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class MessageSent extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return $notifiable->notify_message ? ['mail', 'database'] : ['database'];
    }

    public function toMail($notifiable)
    {
        return (new Mailable($this->message))->to($notifiable->email);
    }

    public function toDatabase($notifiable)
    {
        return [
            'sender' => $this->message->sender->name,
            'receiver' => $this->message->receiver->name,
            'date' => $this->message->created_at
        ];
    }
}
