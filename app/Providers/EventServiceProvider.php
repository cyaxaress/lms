<?php

namespace App\Providers;

use Cyaxaress\Comment\Events\CommentApprovedEvent;
use Cyaxaress\Comment\Events\CommentRejectedEvent;
use Cyaxaress\Comment\Events\CommentSubmittedEvent;
use Cyaxaress\Comment\Listeners\CommentApprovedListener;
use Cyaxaress\Comment\Listeners\CommentRejectedListener;
use Cyaxaress\Comment\Listeners\CommentSubmittedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentApprovedEvent::class => [
            CommentApprovedListener::class
        ],
        CommentRejectedEvent::class => [
            CommentRejectedListener::class
        ],
        CommentSubmittedEvent::class => [
            CommentSubmittedListener::class
        ]
    ];

    public function boot(): void
    {
        parent::boot();

        //
    }
}
