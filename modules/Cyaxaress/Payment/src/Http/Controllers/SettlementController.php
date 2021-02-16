<?php

namespace Cyaxaress\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Payment\Http\Requests\SettlementRequest;
use Cyaxaress\Payment\Repositories\SettlementRepo;

class SettlementController extends Controller
{
    public function index(SettlementRepo $repo)
    {
        $settlements = $repo->paginate();
        return view("Payment::settlements.index", compact("settlements"));
    }

    public function create()
    {
        return view("Payment::settlements.create");
    }

    public function store(SettlementRequest $request, SettlementRepo $repo)
    {
        $repo->store([
           "cart" => $request->cart,
           "name" => $request->name,
            "amount" => $request->amount
        ]);

        newFeedback();
        return redirect(route("settlements.index"));
    }
}
