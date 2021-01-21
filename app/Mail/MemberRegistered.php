<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberRegistered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user, $notifiable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, User $notifiable)
    {
        $this->user = $user;
        $this->notifiable = $notifiable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New member registered in your field')
                    ->markdown('emails.newMember')
                    ->with([
                        'user' => $this->user,
                        'notifiable' => $this->notifiable
                    ]);
    }
}
