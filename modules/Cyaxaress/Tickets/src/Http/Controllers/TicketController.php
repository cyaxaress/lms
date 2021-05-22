<?php
namespace Cyaxaress\Ticket\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\Ticket\Http\Requests\ReplyRequest;
use Cyaxaress\Ticket\Http\Requests\TicketRequest;
use Cyaxaress\Ticket\Models\Ticket;
use Cyaxaress\Ticket\Repositories\TicketRepo;
use Cyaxaress\Ticket\Services\ReplyService;

class TicketController extends Controller{
    public function index(TicketRepo $repo)
    {
        if(auth()->user()->can(Permission::PERMISSION_MANAGE_TICKETS)){
            $tickets = $repo->paginateAll();
        }else{
            $tickets = $repo->paginateAll(auth()->id());
        }
        return view("Tickets::index", compact("tickets"));
    }

    public function show($ticket, TicketRepo $repo)
    {
        $ticket = $repo->findOrFailWithReplies($ticket);
        $this->authorize("show", $ticket);
        return view("Tickets::show", compact("ticket"));
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

    public function reply(Ticket $ticket, ReplyRequest $request)
    {
        $this->authorize("show", $ticket);
        ReplyService::store($ticket, $request->body, $request->attachment);
        newFeedback();
        return redirect()->route("tickets.show", $ticket->id);
    }

    public function close(Ticket $ticket, TicketRepo $repo)
    {
        $this->authorize("show", $ticket);
        $repo->setStatus($ticket->id, Ticket::STATUS_CLOSE);
        newFeedback();
        return redirect()->route("tickets.index");
    }
}
