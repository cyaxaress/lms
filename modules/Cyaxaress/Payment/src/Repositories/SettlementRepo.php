<?php


namespace Cyaxaress\Payment\Repositories;


use Cyaxaress\Payment\Models\Settlement;

class SettlementRepo
{
    private $query;
    public function __construct()
    {
        $this->query = Settlement::query();
    }
    public function store($data)
    {
        return Settlement::query()->create([
            "user_id" => auth()->id(),
           "to" => [
               "cart" => $data["cart"],
               "name" => $data["name"]
           ],
            "amount" => $data["amount"]
        ]);
    }

    public function paginate()
    {
        return $this->query->paginate();
    }

    public function Settled()
    {
        $this->query->where("status", Settlement::STATUS_SETTLED);

        return $this;
    }
}
