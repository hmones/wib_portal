<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as DefaultResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends DefaultResetPassword
{
    public function toMail($notifiable): MailMessage
    {
        $message = $this->buildMailMessage($this->resetUrl($notifiable));

        return $message->from(
            config('mail.from.address'),
            config('mail.from.name')
        );
    }
}
