@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('settlements.index') }}" title="تسویه حساب ها">تسویه حساب ها</a></li>
    <li><a href="#" title="درخواست تسویه حساب جدید">درخواست تسویه حساب جدید</a></li>

@endsection
@section('content')
    <div class="main-content">
        <form action="{{ route("settlements.store")  }}" method="post" class="padding-30 bg-white font-size-14">
            @csrf
            <x-input name="name" type="text" placeholder="نام صاحب حساب" required/>
            <x-input name="cart" type="text" placeholder="شماره کارت" required />
            <x-input name="amount" value="{{ auth()->user()->balance }}" type="text" placeholder="مبلغ به تومان" required />
            <div class="row no-gutters border-2 margin-bottom-15 text-center ">
                <div class="w-50 padding-20 w-50">موجودی قابل برداشت :‌</div>
                <div class="bg-fafafa padding-20 w-50"> {{ number_format(auth()->user()->balance) }} تومان</div>
            </div>
            <div class="row no-gutters border-2 text-center margin-bottom-15">
                <div class="w-50 padding-20">حداکثر زمان واریز :‌</div>
                <div class="w-50 bg-fafafa padding-20">۳ روز</div>
            </div>
            <button type="submit" class="btn btn-webamooz_net">درخواست تسویه</button>
        </form>
    </div>
@endsection
