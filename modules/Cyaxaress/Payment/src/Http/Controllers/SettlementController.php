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
        $repo->store($request->all());
        newFeedback();
        auth()->user()->balance -= $request->amount;
        auth()->user()->save();
        return redirect(route("settlements.index"));
    }

    public function edit($settlement, SettlementRepo $repo)
    {
        $settlement = $repo->find($settlement);
        return view("Payment::settlements.edit", compact("settlement"));
    }

    public function update($settlement, SettlementRequest $request, SettlementRepo $repo)
    {
        $repo->update($settlement, $request->all());
        newFeedback();
        return redirect(route("settlements.index"));
    }
}
