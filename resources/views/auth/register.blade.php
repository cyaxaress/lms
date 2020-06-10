@extends('auth.master')

@section('content')
<form action="" class="form" method="post">
    <a class="account-logo" href="index.html">
        <img src="img/weblogo.png" alt="">
    </a>
    <div class="form-content form-account">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" class="txt @error('name') is-invalid @enderror" placeholder="نام و نام خانوادگی *"
                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
            >
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="email" type="email" class="txt txt-l @error('email') is-invalid @enderror" placeholder="ایمیل *"
                   name="email" value="{{ old('email') }}" required autocomplete="email"
            >
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <input id="mobile" type="text" class="txt txt-l @error('mobile') is-invalid @enderror" placeholder="موبایل"
                   name="mobile" value="{{ old('mobile') }}" autocomplete="mobile"
            >
            @error('mobile')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror


            <input id="password" type="password" class="txt txt-l @error('password') is-invalid @enderror"
                   placeholder="رمز عبور *"
                   name="password" required autocomplete="new-password"
            >
            <input  id="password-confirm" type="password" class="txt txt-l @error('password') is-invalid @enderror"
                    placeholder="تایید رمز عبور *"
                    name="password_confirmation" required autocomplete="new-password"
            >
            <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror



            <br>
            <button class="btn continue-btn">ثبت نام و ادامه</button>
        </form>
    </div>
    <div class="form-footer">
        <a href="{{ route('login') }}">صفحه ورود</a>
    </div>
</form>
@endsection
