<?php

namespace Cyaxaress\Ticket\Repositories;

use Cyaxaress\Ticket\Models\Ticket;
use Illuminate\Database\Eloquent\Model;

class TicketRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Ticket::query();
    }

    public function paginateAll($user_id = null)
    {
        $query = Ticket::query();
        if ($user_id) {
            $query->where("user_id", $user_id);
        }
        return $query->latest()->paginate();
    }

    public function store($title): Model
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

    public function joinUsers()
    {
        $this->query->join("users", "tickets.user_id", "users.id")
        ->select("tickets.*", "users.id", "users.email", "users.name");

        return $this;
    }
    public function searchEmail($email)
    {
        if (!is_null($email))
        $this->query
            ->where("email", "like", "%" . $email . "%");

        return $this;
    }

    public function searchName($name)
    {
        if (!is_null($name))
        $this->query
            ->where("name", "like", "%" . $name . "%");

        return $this;
    }

    public function paginate()
    {
        return $this->query->paginate();
    }

    public function searchTitle($title)
    {
        if (!is_null($title))
        $this->query->where("title", "like", "%" . $title . "%");

        return $this;
    }

    public function searchDate($date)
    {
        if (!is_null($date)) {
            $this->query->whereDate("tickets.created_at", "=", $date);
        }

        return $this;
    }

    public function searchStatus($status)
    {
        if (!is_null($status)) {
            $this->query->where("tickets.status", "=", $status);
        }

        return $this;
    }
}
