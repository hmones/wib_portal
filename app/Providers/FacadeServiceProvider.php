<?php

namespace App\Providers;

use App\Repositories\FileStorage;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind('FileStorage', fn () => resolve(FileStorage::class));
    }
}
