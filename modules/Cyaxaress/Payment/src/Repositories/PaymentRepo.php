<?php

namespace Cyaxaress\Payment\Repositories;

use Cyaxaress\Payment\Models\Payment;

class PaymentRepo
{
    public function store($data)
    {
        return Payment::create([
            "buyer_id" => $data['buyer_id'],
            "paymentable_id" => $data['paymentable_id'],
            "paymentable_type" => $data['paymentable_type'],
            "amount" => $data['amount'],
            "invoice_id" => $data['invoice_id'],
            "gateway" => $data['gateway'],
            "status" => $data['status'],
            "seller_p" => $data['seller_p'],
            "seller_share" => $data['seller_share'],
            "site_share" => $data['site_share'],
        ]);
    }

    public function findByInvoiceId($invoiceId)
    {
        return Payment::where('invoice_id', $invoiceId)->first();
    }

    public function changeStatus($id, string $status)
    {
        return Payment::where("id", $id)->update([
            "status" => $status
        ]);
    }

    public function paginate()
    {
        return Payment::query()->latest()->paginate();
    }

    public function getLastNDaysPayments($status, $days = null)
    {
        $query = Payment::query();

        if (!is_null($days)) $query = $query->where("created_at", ">=", now()->addDays($days));

        return $query->where("status", $status)->latest();
    }

    public function getLastNDaysSuccessPayments($days = null)
    {
        return $this->getLastNDaysPayments(Payment::STATUS_SUCCESS, $days);
    }

    public function getLastNDaysTotal($days = null)
    {
        return $this->getLastNDaysSuccessPayments($days)->sum("amount");
    }

    public function getLastNDaysSiteBenefit($days = null)
    {
        return $this->getLastNDaysSuccessPayments($days)->sum("site_share");
    }


}
