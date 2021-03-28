<?php

namespace Cyaxaress\Payment\Repositories;

use Cyaxaress\Payment\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PaymentRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Payment::query();
    }

    public function store($data, $discounts = [])
    {
        $payment = Payment::create([
            "buyer_id" => $data['buyer_id'],
            "paymentable_id" => $data['paymentable_id'],
            "paymentable_type" => $data['paymentable_type'],
            "seller_id" => $data['seller_id'],
            "amount" => $data['amount'],
            "invoice_id" => $data['invoice_id'],
            "gateway" => $data['gateway'],
            "status" => $data['status'],
            "seller_p" => $data['seller_p'],
            "seller_share" => $data['seller_share'],
            "site_share" => $data['site_share'],
        ]);

        foreach ($discounts as $discount) $discountIds[] = $discount->id;

        if (isset($discountIds))
            $payment->discounts()->sync($discountIds);

        return $payment;
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

    public function searchEmail($email)
    {
        if (!is_null($email)) {
            $this->query->join("users", "payments.buyer_id", 'users.id')->select("payments.*", "users.email")->where("email", "like", "%" . $email . "%");
        }

        return $this;
    }

    public function searchAmount($amount)
    {
        if (!is_null($amount)) {
            $this->query->where("amount", $amount);
        }

        return $this;
    }


    public function searchInvoiceId($invoiceId)
    {
        if (!is_null($invoiceId)) {
            $this->query->where("invoice_id", "like", "%" . $invoiceId . "%");
        }

        return $this;
    }

    public function searchAfterDate($date)
    {
        if (!is_null($date)) {
            $this->query->whereDate("created_at", ">=", $date);
        }

        return $this;
    }

    public function searchBeforeDate($date)
    {
        if (!is_null($date)) {
            $this->query->whereDate("created_at", "<=", $date);
        }

        return $this;
    }


    public function paginate()
    {
        return $this->query->latest()->paginate();
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

    public function getUserSuccessPayments($userId)
    {
        return Payment::where("seller_id", $userId)->where("status", Payment::STATUS_SUCCESS);;
    }

    public function getUserTotalSuccessAmount($userId)
    {
        return $this->getUserSuccessPayments($userId)->sum("amount");
    }

    public function getUserTotalBenefit($userId)
    {
        return $this->getUserSuccessPayments($userId)->sum("seller_share");
    }

    public function getUserTotalSellByDay($userId, $date)
    {
        return $this->getUserSuccessPayments($userId)->whereDate("created_at", $date)->sum("amount");
    }

    public function getUserSellCountByDay($userId, $date)
    {
        return $this->getUserSuccessPayments($userId)->whereDate("created_at", $date)->count();
    }

    public function getUserTotalBenefitByDay($userId, $date)
    {
        return $this->getUserSuccessPayments($userId)->whereDate("created_at", $date)
            ->sum("seller_share");
    }


    public function getUserTotalBenefitByPeriod($userId, $startDate, $endDate)
    {
        return Payment::where("seller_id", $userId)
            ->where("status", Payment::STATUS_SUCCESS)
            ->whereDate("created_at", "<= ", $startDate)
            ->whereDate("created_at", ">=", $endDate)
            ->sum("seller_share");
    }

    public function getUserTotalSiteShare($userId)
    {
        return $this->getUserSuccessPayments($userId)->sum("site_share");
    }


    public function getLastNDaysTotal($days = null)
    {
        return $this->getLastNDaysSuccessPayments($days)->sum("amount");
    }

    public function getLastNDaysSiteBenefit($days = null)
    {
        return $this->getLastNDaysSuccessPayments($days)->sum("site_share");
    }

    public function getLastNDaysSellerShare($days = null)
    {
        return $this->getLastNDaysSuccessPayments($days)->sum("seller_share");
    }

    public function getDayPayments($day, $status)
    {
        return $query = Payment::query()->whereDate("created_at", $day)->where("status", $status)->latest();
    }

    public function getDaySuccessPayments($day)
    {
        return $this->getDayPayments($day, Payment::STATUS_SUCCESS);
    }

    public function getDayFailedPayments($day)
    {
        return $this->getDayPayments($day, Payment::STATUS_FAIL);
    }

    public function getDaySuccessPaymentsTotal($day)
    {
        return $this->getDaySuccessPayments($day)->sum("amount");
    }

    public function getDayFailedPaymentsTotal($day)
    {
        return $this->getDayFailedPayments($day)->sum("amount");
    }

    public function getDaySiteShare($day)
    {
        return $this->getDaySuccessPayments($day)->sum("site_share");
    }

    public function getDaySellerShare($day)
    {
        return $this->getDaySuccessPayments($day)->sum("seller_share");
    }

    public function getDailySummery(Collection $dates, $seller_id = null)
    {
        $query = Payment::query()->where("created_at", ">=", $dates->keys()->first())
            ->groupBy("date")
            ->orderBy("date");

        if (!is_null($seller_id))
            $query->where("seller_id", $seller_id);

        return $query->get([
            DB::raw("DATE(created_at) as date"),
            DB::raw("SUM(amount) as totalAmount"),
            DB::raw("SUM(seller_share) as totalSellerShare"),
            DB::raw("SUM(site_share) as totalSiteShare"),
        ]);
    }

    public function paymentsBySellerId(int $id)
    {
        return Payment::query()->where("seller_id", $id);
    }
}
