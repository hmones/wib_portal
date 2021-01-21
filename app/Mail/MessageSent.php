<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new message instance.
     * @param Message $message
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You received a new message')
                    ->markdown('emails.newMessage')
                    ->with([
                        'message' => $this->message,
                        'path' => url('/') . '/messenger'
                    ]);
    }
}
