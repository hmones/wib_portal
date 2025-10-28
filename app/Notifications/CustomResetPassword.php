<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as DefaultResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends DefaultResetPassword
{
    public function envelope(): Envelope
    {
        return new Envelope(
            from: config('mail.from.address'),
            subject: Lang::get('Reset Password Notification'),
        );
    }

    public function toMail($notifiable): MailMessage
    {
        $url = $this->resetUrl($notifiable);

        return (new MailMessage)
        ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
        ->action(Lang::get('Reset Password'), $url)
        ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
        ->line(Lang::get('If you did not request a password reset, no further action is required.'));
    }
}
