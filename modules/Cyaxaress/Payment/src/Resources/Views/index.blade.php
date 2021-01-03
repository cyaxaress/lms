@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('payments.index') }}" title="تراکنش ها">تراکنش ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>کل فروش ۳۰ روز گذشته سایت </p>
            <p>{{ number_format($last30DaysTotal) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>درامد خالص ۳۰ روز گذشته سایت</p>
            <p>{{ number_format($last30DaysBenefit) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>کل فروش سایت</p>
            <p>{{ number_format($totalSell) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p> کل درآمد خالص سایت</p>
            <p>{{ number_format($totalBenefit) }} تومان</p>
        </div>
    </div>
    <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
        <p class="box__title">تراکنش ها</p>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام و نام خانوادگی</th>
                    <th>ایمیل پرداخت کننده</th>
                    <th>مبلغ (تومان)</th>
                    <th>درامد مدرس</th>
                    <th>درامد سایت</th>
                    <th>نام دوره</th>
                    <th>تاریخ و ساعت</th>
                    <th>وضعیت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr role="row" class="">
                        <td><a href="">{{ $payment->id }}</a></td>
                        <td>{{ $payment->buyer->name }}</td>
                        <td>{{ $payment->buyer->email }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->seller_share }}</td>
                        <td>{{ $payment->site_share }}</td>
                        <td>{{ $payment->paymentable->title }}</td>
                        <td>{{ $payment->created_at }}</td>
                        <td class="@if($payment->status == \Cyaxaress\Payment\Models\Payment::STATUS_SUCCESS) text-success @else text-error @endif">@lang($payment->status)</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script>
        @include('Common::layouts.feedbacks')
    </script>
@endsection
