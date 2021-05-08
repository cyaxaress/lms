<?php
namespace Cyaxaress\Ticket\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Ticket\Http\Requests\TicketRequest;
use Cyaxaress\Ticket\Repositories\TicketRepo;

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

    public function store(TicketRequest $request)
    {

    }
}
