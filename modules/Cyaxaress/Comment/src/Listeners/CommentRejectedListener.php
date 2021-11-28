<?php

namespace Cyaxaress\Comment\Listeners;

use Cyaxaress\Comment\Notifications\CommentApprovedNotification;
use Cyaxaress\Comment\Notifications\CommentRejectedNotification;
use Cyaxaress\Comment\Notifications\CommentSubmittedNotification;

class CommentRejectedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $event->comment->user->notify(new CommentRejectedNotification($event->comment));
    }
}
