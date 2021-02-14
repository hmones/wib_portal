<?php

namespace App\Console;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        //
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            User::destroy(DB::table('users')->where('active', 0)->pluck('id'));
            Post::destroy(DB::table('posts')->where('active', 0)->pluck('id'));
            Comment::destroy(DB::table('comments')->where('active', 0)->pluck('id'));
        })->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
