<?php
namespace Cyaxaress\Ticket\Repositories;

use Cyaxaress\Ticket\Models\Ticket;

class TicketRepo{
    public function paginateAll()
    {
        return Ticket::query()->latest()->paginate();
    }

    public function store($title)
    {
        return Ticket::query()->create([
            "title" => $title,
            "user_id" => auth()->id(),

        ]);
    }
}
