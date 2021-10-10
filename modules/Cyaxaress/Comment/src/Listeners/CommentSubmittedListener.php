<?php

namespace Cyaxaress\Comment\Listeners;

use Cyaxaress\Comment\Notifications\CommentSubmittedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentSubmittedListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->comment->commentable->teacher->notify(new CommentSubmittedNotification($event->comment));
    }
}
