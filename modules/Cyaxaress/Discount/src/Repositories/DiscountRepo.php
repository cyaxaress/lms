<?php
namespace Cyaxaress\Discount\Repositories;

use Cyaxaress\Discount\Models\Discount;
use Morilog\Jalali\Jalalian;

class DiscountRepo{
    public function store($data)
    {
        Discount::query()->create([
            "user_id" => auth()->id(),
            "code" => $data["code"],
            "percent" => $data["percent"],
            "usage_limitation" => $data["usage_limitation"],
            "expire_at" => Jalalian::fromFormat("Y/m/d H:i", $data["expire_at"])->toCarbon(),
            "link" => $data["link"],
            "description" => $data["description"],
            "uses" => 0
        ]);
    }

    public function paginateAll()
    {
        return Discount::query()->latest()->paginate();
    }
}
