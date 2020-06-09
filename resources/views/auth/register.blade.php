@extends('auth.master')

@section('content')
<form action="" class="form" method="post">
    <a class="account-logo" href="index.html">
        <img src="img/weblogo.png" alt="">
    </a>
    <div class="form-content form-account">
        <input type="text" class="txt" placeholder="نام و نام خانوادگی">
        <input type="text" class="txt txt-l" placeholder="ایمیل">
        <input type="text" class="txt txt-l" placeholder="شماره موبایل">
        <input type="text" class="txt txt-l" placeholder="رمز عبور">
        <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
        <br>
        <button class="btn continue-btn">ثبت نام و ادامه</button>

    </div>
    <div class="form-footer">
        <a href="login.html">صفحه ورود</a>
    </div>
</form>
@endsection
