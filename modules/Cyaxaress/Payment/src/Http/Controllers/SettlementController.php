<?php

namespace Cyaxaress\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Payment\Http\Requests\SettlementRequest;
use Cyaxaress\Payment\Models\Settlement;
use Cyaxaress\Payment\Repositories\SettlementRepo;
use Cyaxaress\Payment\Services\SettlementService;
use Cyaxaress\RolePermissions\Models\Permission;

class SettlementController extends Controller
{
    public function index(SettlementRepo $repo)
    {
        $this->authorize('index', Settlement::class);
        if (auth()->user()->can(Permission::PERMISSION_MANAGE_SETTLEMENTS))
            $settlements = $repo->latest()->paginate();
        else
            $settlements = $repo->paginateUserSettlements(auth()->id());
        return view("Payment::settlements.index", compact("settlements"));
    }

    public function create(SettlementRepo $repo)
    {
        $this->authorize('store', Settlement::class);
        if ($repo->getLatestPendingSettlement(auth()->id())){
            newFeedback("ناموفق", "شما یک درخواست تسویه در حال انتظار دارید و نمیتوانید درخواست جدیدی فعلا ثبت بکنید.", "error");
            return  redirect()->route("settlements.index");
        }
        return view("Payment::settlements.create");
    }

    public function store(SettlementRequest $request, SettlementRepo $repo)
    {
        $this->authorize('store', Settlement::class);
        if ($repo->getLatestPendingSettlement(auth()->id())){
            newFeedback("ناموفق", "شما یک درخواست تسویه در حال انتظار دارید و نمیتوانید درخواست جدیدی فعلا ثبت بکنید.", "error");
            return  redirect()->route("settlements.index");
        }
        SettlementService::store($request->all());
        return redirect(route("settlements.index"));
    }

    public function edit($settlementId, SettlementRepo $repo)
    {
        $requestedSettlement = $repo->find($settlementId);
        $settlement = $repo->getLatestSettlement($requestedSettlement->user_id);
        $this->authorize('manage', Settlement::class);
        if ($settlement->id != $settlementId){
            newFeedback("ناموفق", "این درخواست تسویه قابل ویرایش نیست و بایگانی شده است. فقط آخرین درخواست تسویه ی هر کاربر قابل ویرایش است.", "error");
            return  redirect()->route("settlements.index");
        }

        return view("Payment::settlements.edit", compact("settlement"));
    }

    public function update($settlementId, SettlementRequest $request, SettlementRepo $repo)
    {
        $requestedSettlement = $repo->find($settlementId);
        $settlement = $repo->getLatestSettlement($requestedSettlement->user_id);
        $this->authorize('manage', Settlement::class);
        if ($settlement->id != $settlementId){
            newFeedback("ناموفق", "این درخواست تسویه قابل ویرایش نیست و بایگانی شده است. فقط آخرین درخواست تسویه ی هر کاربر قابل ویرایش است.", "error");
            return  redirect()->route("settlements.index");
        }
        SettlementService::update($settlementId, $request->all());
        return redirect(route("settlements.index"));
    }
}
