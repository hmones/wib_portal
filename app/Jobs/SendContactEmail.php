<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $auth_user;
    protected $profile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($profile, $auth_user)
    {
        $this->profile = $profile;
        $this->auth_user = $auth_user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $profile = $this->profile;
        $auth_user = $this->auth_user;

        Mail::send('emails.contact', ['user' => $profile, 'auth_user' => $auth_user], function ($m) use ($profile, $auth_user) {
            $m->from('noreply@womeninbusiness-mena.com', 'Women in Business Portal');
            $m->to($profile->email)
                ->bcc('esseghairi@gpp-berlin.de')
                ->replyTo($auth_user->email, $auth_user->name)
                ->subject('A new contact request!');
        });
    }
}
