<?php

namespace Cyaxaress\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Payment\Repositories\PaymentRepo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(PaymentRepo $paymentRepo)
    {
        $totalSales = $paymentRepo->getUserTotalSuccessAmount(auth()->id());
        $totalBenefit = $paymentRepo->getUserTotalBenefit(auth()->id());
        $totalSiteShare = $paymentRepo->getUserTotalSiteShare(auth()->id());
        $todayBenefit = $paymentRepo->getUserTotalBenefitByDay(auth()->id(), now());
        $last30DaysBenefit = $paymentRepo->getUserTotalBenefitByPeriod(auth()->id(), now(), now()->addDays(-30));
        $todaySuccessPaymentsTotal = $paymentRepo->getUserTotalSellByDay(auth()->id(), now());
        $todaySuccessPaymentsCount = $paymentRepo->getUserSellCountByDay(auth()->id(), now());
        return view('Dashboard::index', compact(
            "totalSales",
            "totalBenefit",
            "totalSiteShare",
            "todayBenefit",
            "last30DaysBenefit",
            "todaySuccessPaymentsTotal",
            "todaySuccessPaymentsCount"
            )
        );
    }
}
