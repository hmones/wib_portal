<?php

namespace App\Mail;

use App\Models\B2bApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class B2bApplicationStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    protected $application;

    public function __construct(B2bApplication $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->subject('Your application to WiB B2B program')
            ->markdown('emails.applicationStatus')
            ->with(['application' => $this->application]);
    }
}
