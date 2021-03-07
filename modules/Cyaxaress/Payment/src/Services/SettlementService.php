<?php


namespace Cyaxaress\Payment\Services;


use Cyaxaress\Payment\Models\Settlement;
use Cyaxaress\Payment\Repositories\SettlementRepo;

class SettlementService
{
    public static function store(array $data)
    {
        $repo = new SettlementRepo();
        $repo->store($data);
        auth()->user()->balance -= $data["amount"];
        auth()->user()->save();
        newFeedback();
    }

    public static function update(int $settlement,array $data)
    {
        $repo = new SettlementRepo();
        $settlement = $repo->find($settlement);
        if (!in_array($settlement->status, [Settlement::STATUS_CANCELLED, Settlement::STATUS_REJECTED]) &&
            in_array($data["status"], [Settlement::STATUS_CANCELLED, Settlement::STATUS_REJECTED])){
            $settlement->user->balance += $settlement->amount;
            $settlement->user->save();
        }
        if (in_array($settlement->status, [Settlement::STATUS_CANCELLED, Settlement::STATUS_REJECTED]) &&
            in_array($data["status"], [Settlement::STATUS_SETTLED, Settlement::STATUS_PENDING])
        ){
            if (
                $settlement->user->balance < $settlement->amount){
                newFeedback("ناموفق", "موجودی حساب کاربر کافی نمیباشد!", 'error');
                return;
            }
            $settlement->user->balance -= $settlement->amount;
            $settlement->user->save();
        }
        $repo->update($settlement->id, $data);
        newFeedback();
    }


}
