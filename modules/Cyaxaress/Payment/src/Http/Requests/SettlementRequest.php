<?php

namespace Cyaxaress\Payment\Http\Requests;

use Cyaxaress\Payment\Models\Settlement;
use Illuminate\Foundation\Http\FormRequest;

class SettlementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $min = 1000;
        if (request()->getMethod() === "PATCH") {
            return [
                "from.name" => "required_if:status," . Settlement::STATUS_SETTLED,
                "from.cart" => "required_if:status," . Settlement::STATUS_SETTLED,
                "to.name" => "required_if:status," . Settlement::STATUS_SETTLED,
                "to.cart" => "required_if:status," . Settlement::STATUS_SETTLED,
                "amount" => "required|numeric|min:{$min}",
            ];
        }
        return [
            "name" => "required",
            "cart" => "required|numeric",
            "amount" => "required|numeric|min:{$min}|max:" . auth()->user()->balance
        ];
    }

    public function attributes()
    {
        return [
            "cart" => "شماره کارت",
            "amount" => "مبلغ تسویه حساب"
        ];
    }
}
