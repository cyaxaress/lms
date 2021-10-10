<?php

namespace Cyaxaress\Comment\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentSubmittedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
