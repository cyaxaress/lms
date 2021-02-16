<?php

namespace Cyaxaress\Payment\Http\Requests;

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
        return [
            "name" => "required",
            "cart" => "required|numeric",
            "amount" => "required|numeric|max:" . auth()->user()->balance
        ];
    }

    public function attributes()
    {
        return [
            "cart"=> "شماره کارت",
            "amount" => "مبلغ تسویه حساب"
        ];
    }
}
