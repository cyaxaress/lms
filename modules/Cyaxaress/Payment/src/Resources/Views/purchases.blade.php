@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('purchases.index') }}" title="خریدهای من">خریدهای من</a></li>
@endsection
@section('content')
    <div class="table__box">
        <table class="table">
            <thead>
            <tr class="title-row">
                <th>عنوان دوره</th>
                <th>تاریخ پرداخت</th>
                <th>مقدار پرداختی</th>
                <th>وضعیت پرداخت</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
            <tr>
                <td><a href="{{ $payment->paymentable->path() }}" target="_blank">{{ $payment->paymentable->title }}</a></td>
                <td>{{ createFromCarbon($payment->created_at) }}</td>
                <td>{{ number_format($payment->amount) }} تومان</td>
                <td class="{{ $payment->status == \Cyaxaress\Payment\Models\Payment::STATUS_SUCCESS  ? "text-success" :"text-error" }}">@lang($payment->status)</td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{ $payments->render() }}
    </div>
@endsection
