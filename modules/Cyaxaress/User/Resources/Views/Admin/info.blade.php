@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 border-radius-3 bg-white margin-bottom-10">
            <p class="box__title">اطلاعات کامل حساب کاربری <strong>{{ $user->name }}</strong></p>
            <div class="w-100 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <ul>
                    <li>ایمیل: <strong><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></strong></li>
                    <li>نام کاربری: <strong>{{ $user->username }}</strong></li>
                    <li>موبایل: <strong>{{ $user->mobile }}</strong></li>
                    <li>عنوان: <strong>{{ $user->headline }}</strong></li>
                    <li>بیو: <strong>{{ $user->bio }}</strong></li>
                    <li>موجودی حساب: <strong>{{ $user->balance }}</strong></li>
                    <li>تاریخ تایید ایمیل: <strong>{{ $user->email_verified_at ? \Morilog\Jalali\Jalalian::fromCarbon($user->email_verified_at) : "تایید نشده" }}</strong></li>
                </ul>
            </div>
        </div>
        <div class="col-6 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p class="box__title">دوره های خریداری شده</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>دوره</th>
                        <th>مبلغ پرداخت شده</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->purchases as $purchase)
                        <tr role="row" class="">
                            <td>{{ $purchase->id }}</td>
                            <td><a href="{{ $purchase->path() }}">{{ $purchase->title }}</a></td>
                            <td>{{ $purchase->payment()->amount }}</td>
                            <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($purchase->created_at) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6 border-radius-3 bg-white margin-bottom-10">
            <p class="box__title">دوره های درحال تدریس</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>عنوان دوره</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->courses as $course)
                        <tr role="row" class="">
                            <td>{{ $course->id }}</td>
                            <td><a href="{{ $course->path() }}">{{ $course->title }}</a></td>
                            <td>@lang($course->status)</td>
                            <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($course->created_at) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="col-6 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p class="box__title">پرداخت ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>محصول</th>
                        <th>مبلغ پرداخت</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->payments as $payment)
                        <tr role="row" class="">
                            <td>{{ $payment->id }}</td>
                            <td><a href="{{ $payment->paymentable->path() }}">{{  $payment->paymentable->title }}</a></td>
                            <td>{{ $payment->amount }}</td>
                            <td>@lang($payment->status)</td>
                            <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($payment->created_at) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-6 border-radius-3 bg-white margin-bottom-10">
            <p class="box__title">درخواست های تسویه</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>مبلغ پرداخت</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->settlements as $settlement)
                        <tr role="row" class="">
                            <td>{{ $settlement->id }}</td>
                            <td>{{ $settlement->amount }}</td>
                            <td>@lang($settlement->status)</td>
                            <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($settlement->created_at) }}</td>
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
