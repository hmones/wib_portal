<?php

namespace App\Jobs;

use App\Repositories\CommentRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function handle()
    {
        resolve(CommentRepository::class)->destroy($this->comment);
    }
}
