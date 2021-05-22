<?php
namespace Cyaxaress\Ticket\Repositories;

use Cyaxaress\Ticket\Models\Ticket;
use Illuminate\Database\Eloquent\Model;

class TicketRepo{
    public function paginateAll($user_id = null)
    {
        $query = Ticket::query();
        if ($user_id){
            $query->where("user_id", $user_id);
        }
        return $query->latest()->paginate();
    }

    public function store($title) : Model
    {
        return Ticket::query()->create([
            "title" => $title,
            "user_id" => auth()->id(),

        ]);
    }

    public function findOrFailWithReplies($ticket)
    {
        return Ticket::query()->with("replies")->findOrFail($ticket);
    }

    public function setStatus($id, string $status)
    {
        return Ticket::query()->where("id", $id)->update(["status" => $status]);
    }
}
