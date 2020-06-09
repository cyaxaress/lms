@extends('auth.master')

@section('content')
    <form action="" class="form" method="post">
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" class="txt-l txt" placeholder="ایمیل یا شماره موبایل">
            <input type="text"class="txt-l txt" placeholder="رمز عبور">
            <br>
            <button class="btn btn--login">ورود</button>
            <label class="ui-checkbox">
                مرا بخاطر داشته باش
                <input type="checkbox" checked="checked">
                <span class="checkmark"></span>
            </label>
            <div class="recover-password">
                <a href="recoverpassword.html">بازیابی رمز عبور</a>
            </div>
        </div>
        <div class="form-footer">
            <a href="register.html">صفحه ثبت نام</a>
        </div>
    </form>
@endsection
