<?php

namespace Cyaxaress\Ticket\Services;

use Cyaxaress\Media\Services\MediaFileService;
use Cyaxaress\Ticket\Models\Ticket;
use Cyaxaress\Ticket\Repositories\ReplyRepo;
use Illuminate\Http\UploadedFile;

class ReplyService
{
    static function store(Ticket $ticket, $reply, $attachment)
    {
        $repo = new ReplyRepo();
        $media_id = null;
        if ($attachment && ( $attachment instanceof UploadedFile)){
            $media_id = MediaFileService::privateUpload($attachment)->id;
        }

        return $repo->store($ticket->id, $reply, $media_id);
    }
}
