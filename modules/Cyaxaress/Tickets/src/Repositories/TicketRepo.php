<?php
namespace Cyaxaress\Ticket\Repositories;

use Cyaxaress\Ticket\Models\Ticket;

class TicketRepo{
    public function paginateAll()
    {
        return Ticket::query()->latest()->paginate();
    }
}
