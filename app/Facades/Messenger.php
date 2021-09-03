<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * @method static string pusherAuth($channelName, $socket_id, $data = [])
 * @method static Application|Factory|View messageCard($data, $viewType = null)
 */
class Messenger extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Messenger';
    }
}
