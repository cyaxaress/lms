<?php
namespace Cyaxaress\Ticket\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Media\Services\MediaFileService;
use Cyaxaress\Ticket\Http\Requests\TicketRequest;
use Cyaxaress\Ticket\Repositories\TicketRepo;
use Cyaxaress\Ticket\Services\ReplyService;

class TicketController extends Controller{
    public function index(TicketRepo $repo)
    {
        $tickets = $repo->paginateAll();
        return view("Tickets::index", compact("tickets"));
    }

    public function create()
    {
        return view("Tickets::create");
    }

    public function store(TicketRequest $request, TicketRepo $repo)
    {
        $ticket = $repo->store($request->title);
        ReplyService::store($ticket, $request->body, $request->attachment);
        newFeedback();
        return redirect()->route("tickets.index");
    }
}
