<?php

namespace App\Console;

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
            DB::table('users')->where('active', 0)->delete();
            DB::table('posts')->where('active', 0)->delete();
            DB::table('comments')->where('active', 0)->delete();
        })->daily();

        $schedule->command('scout:import "App\Models\User"')->daily();
        $schedule->command('scout:import "App\Models\Post"')->daily();
        $schedule->command('scout:import "App\Models\Entity"')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
