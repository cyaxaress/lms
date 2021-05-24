<?php
namespace Cyaxaress\Ticket\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Common\Responses\AjaxResponses;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\Ticket\Http\Requests\ReplyRequest;
use Cyaxaress\Ticket\Http\Requests\TicketRequest;
use Cyaxaress\Ticket\Models\Reply;
use Cyaxaress\Ticket\Models\Ticket;
use Cyaxaress\Ticket\Repositories\TicketRepo;
use Cyaxaress\Ticket\Services\ReplyService;
use Illuminate\Http\Request;

class TicketController extends Controller{
    public function index(TicketRepo $repo, Request $request)
    {
        if(auth()->user()->can(Permission::PERMISSION_MANAGE_TICKETS)){
            $tickets = $repo->joinUsers()
                ->searchEmail($request->email)
                ->searchName($request->name)
                ->searchTitle($request->title)
                ->searchDate(dateFromJalali($request->date))
                ->searchStatus($request->status)
                ->paginate();
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

    public function destroy(Ticket $ticket)
    {
        $this->authorize("delete", $ticket);
        $hasAttachments = Reply::query()->where("ticket_id", $ticket->id)->whereNotNull("media_id")->with("media")->get();
        foreach ($hasAttachments as $reply){
            $reply->media->delete();
        }
        $ticket->delete();
        return AjaxResponses::SuccessResponse();
    }
}
