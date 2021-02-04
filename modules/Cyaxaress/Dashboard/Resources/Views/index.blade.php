@extends('Dashboard::master')

@section('content')
    @can(\Cyaxaress\RolePermissions\Models\Permission::PERMISSION_TEACH)
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> موجودی حساب فعلی </p>
            <p>{{ number_format(auth()->user()->balance) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> کل فروش دوره ها</p>
            <p>{{ number_format($totalSales) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> کارمزد کسر شده </p>
            <p>{{ number_format($totalSiteShare) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p> درآمد خالص </p>
            <p>{{ number_format($totalBenefit) }} تومان</p>
        </div>
    </div>
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> درآمد امروز </p>
            <p>{{ number_format($todayBenefit) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> درآمد 30 روز گذاشته</p>
            <p>{{ number_format($last30DaysBenefit) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> تسویه حساب در حال انجام </p>
            <p>0 تومان </p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white  margin-bottom-10">
            <p>تراکنش های موفق امروز ({{ $todaySuccessPaymentsCount }}) تراکنش </p>
            <p>{{ number_format($todaySuccessPaymentsTotal) }} تومان</p>
        </div>
    </div>
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-8 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
            <div class="col-12 bg-white padding-30 margin-bottom-20">
                <div id="container"></div>
            </div>
        </div>
        <div class="col-4 info-amount padding-20 bg-white margin-bottom-12-p margin-bottom-10 border-radius-3">

            <p class="title icon-outline-receipt">موجودی قابل تسویه </p>
            <p class="amount-show color-444">
                {{ number_format(auth()->user()->balance) }}<span> تومان </span></p>
            <p class="title icon-sync">در حال تسویه</p>
            <p class="amount-show color-444">0<span> تومان </span></p>
            <a href="/" class=" all-reconcile-text color-2b4a83">همه تسویه حساب ها</a>
        </div>
    </div>
    @endcan
    <div class="row bg-white no-gutters font-size-13">
        <div class="title__row">
            <p>تراکنش های اخیر شما</p>
            <a class="all-reconcile-text margin-left-20 color-2b4a83">نمایش همه تراکنش ها</a>
        </div>
        <div class="table__box">
            <table width="100%" class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه پرداخت</th>
                    <th>ایمیل پرداخت کننده</th>
                    <th>مبلغ (تومان)</th>
                    <th>درامد شما</th>
                    <th>درامد سایت</th>
                    <th>نام دوره</th>
                    <th>تاریخ و ساعت</th>
                    <th>وضعیت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr role="row" class="">
                        <td>{{ $payment->invoice_id }}</td>
                        <td>{{ $payment->buyer->email }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->seller_share }}</td>
                        <td>{{ $payment->site_share }}</td>
                        <td>{{ $payment->paymentable->title }}</td>
                        <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($payment->created_at) }}</td>
                        <td class="@if($payment->status == \Cyaxaress\Payment\Models\Payment::STATUS_SUCCESS) text-success @else text-error @endif">@lang($payment->status)</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section("js")
    @include("Payment::chart")
@endsection
