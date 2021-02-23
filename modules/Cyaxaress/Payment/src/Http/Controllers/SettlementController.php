<?php

namespace Cyaxaress\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Payment\Http\Requests\SettlementRequest;
use Cyaxaress\Payment\Repositories\SettlementRepo;
use Cyaxaress\Payment\Services\SettlementService;

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

    public function store(SettlementRequest $request)
    {
        SettlementService::store($request->all());
        return redirect(route("settlements.index"));
    }

    public function edit($settlement, SettlementRepo $repo)
    {
        $settlement = $repo->find($settlement);
        return view("Payment::settlements.edit", compact("settlement"));
    }

    public function update($settlement, SettlementRequest $request)
    {
        SettlementService::update($settlement, $request->all());
        return redirect(route("settlements.index"));
    }
}
