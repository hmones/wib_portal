<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Entity;
use App\Models\Post;
use App\Observers\CommentObserver;
use App\Observers\EntityObserver;
use App\Observers\PostObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
        Entity::observe(EntityObserver::class);
        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
