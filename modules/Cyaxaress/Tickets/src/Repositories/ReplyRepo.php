<?php

namespace Cyaxaress\Ticket\Repositories;

use Cyaxaress\Ticket\Models\Reply;

class ReplyRepo
{

    public function store($ticketId, $body, $mediaId = null)
    {
        return Reply::query()->create([
            "user_id" => auth()->id(),
            "ticket_id" => $ticketId,
            "body" => $body,
            "media_id" => $mediaId
        ]);
    }
}
