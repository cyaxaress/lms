@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('settlements.index') }}" title="تسویه حساب ها">تسویه حساب ها</a></li>
    <li><a href="#" title="ویرایش درخواست تسویه حساب">ویرایش درخواست تسویه حساب</a></li>

@endsection
@section('content')
    <div class="main-content">
        <form action="{{ route("settlements.update", $settlement->id)  }}" method="post" class="padding-30 bg-white font-size-14">
            @csrf
            @method("patch")
            <x-input name="from[name]" value='{{ is_array($settlement->from) && array_key_exists("name", $settlement->from) ? $settlement->from["name"] : "" }}' type="text" placeholder="نام صاحب حساب فرستنده "/>
            <x-input name="from[cart]" value='{{ is_array($settlement->from) && array_key_exists("cart", $settlement->from) ? $settlement->from["cart"] : "" }}' type="text" placeholder="شماره کارت فرستنده" />

            <x-input name="to[name]" value='{{ is_array($settlement->to) && array_key_exists("name", $settlement->to) ? $settlement->to["name"] : "" }}' type="text" placeholder="نام صاحب حساب گیرنده" required/>
            <x-input name="to[cart]" value='{{ is_array($settlement->to) && array_key_exists("cart", $settlement->to) ? $settlement->to["cart"] : "" }}' type="text" placeholder="شماره کارت گیرنده" required />
            <x-input name="amount" value="{{ $settlement->amount }}" readonly type="text" placeholder="مبلغ به تومان" required />
            <x-select name="status" >
                @foreach(\Cyaxaress\Payment\Models\Settlement::$statues as $status)
                    <option value="{{ $status }}" {{ $settlement->status == $status ? "selected"  : ""}}>@lang($status)</option>
                @endforeach
            </x-select>
            <div class="row no-gutters border-2 margin-bottom-15 text-center ">
                <div class="w-50 padding-20 w-50">باقی مانده ی حساب :‌</div>
                <div class="bg-fafafa padding-20 w-50"> {{ number_format($settlement->user->balance) }} تومان</div>
            </div>
            <button type="submit" class="btn btn-webamooz_net">بروزرسانی</button>
        </form>
    </div>
@endsection
