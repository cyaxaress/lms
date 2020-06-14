@extends('auth.master')

@section('content')
<div class="form">
    <a class="account-logo" href="/">
        <img src="/img/weblogo.png" alt="">
    </a>
    <div class="form-content form-account">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                یک لینک تایید ایمیل جدید به ایمیلتان ارسال شد.
            </div>
        @endif

        قبل از ادامه لطفا ایمیلتان را چک کنید
        اگر ایمیلی دریافت نکرده اید درخواست ارسال مجدد لینک بدهید.
        <form class="d-inline center" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">ارسال مجددا کد لینک تایید</button>
            <a href="/" class="">بازگشت به صفحه ی اصلی</a>
        </form>
    </div>
</div>
@endsection
