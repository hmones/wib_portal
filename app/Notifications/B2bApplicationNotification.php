<?php

namespace App\Notifications;

use App\Mail\B2bApplicationStatusChanged;
use App\Models\B2bApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class B2bApplicationNotification extends Notification
{
    use Queueable;

    protected $application;

    public function __construct(B2bApplication $application)
    {
        $this->application = $application;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): Mailable
    {
        return (new B2bApplicationStatusChanged($this->application))->from(config('mail.from.address'))->to($notifiable->email);
    }
}
