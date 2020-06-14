@extends('auth.master')

@section('content')
    <form action="" class="form" method="post">
        <a class="account-logo" href="index.html">
            <img src="/img/weblogo.png" alt="">
        </a>
        <div class="card-header">
            <p class="activation-code-title">کد فرستاده شده به ایمیل  <span>Mohammadniko3@gmail.com</span> را وارد کنید</p>
        </div>
        <div class="form-content form-content1">
            <input class="activation-code-input" placeholder="فعال سازی">
            <br>
            <button class="btn i-t">تایید</button>

        </div>
        <div class="form-footer">
            <a href="login.html">صفحه ثبت نام</a>
        </div>
    </form>
@endsection
