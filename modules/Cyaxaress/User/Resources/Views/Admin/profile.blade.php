@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ویرایش کاربر">ویرایش پروفایل</a></li>
@endsection
@section('content')
    <div class="row no-gutters margin-bottom-20">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی پروفایل</p>
            <x-user-photo />
            <form action="{{ route('users.profile')}}" class="padding-30" method="post">
                @csrf
                <x-input name="name" placeholder="نام کاربری" type="text" value="{{ auth()->user()->name }}" required/>
                <x-input type="text" name="email" placeholder="ایمیل" value="{{ auth()->user()->email }}" class="text-left" required />
                <x-input type="text" name="mobile" placeholder="موبایل" value="{{ auth()->user()->mobile }}" class="text-left"  />
                <x-input type="password" name="password" placeholder="پسورد جدید" value=""  />
                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&amp;*()</strong> باشد.</p>
                @can(\Cyaxaress\RolePermissions\Models\Permission::PERMISSION_TEACH)
                <x-input type="text" name="card_number" placeholder="شماره کارت بانکی" value="{{ auth()->user()->card_number }}" class="text-left"  />
                <x-input type="text" name="shaba" placeholder="شماره شبا بانکی" value="{{ auth()->user()->shaba }}" class="text-left"  />
                <x-input type="text" name="username" placeholder="نام کاربری و آدرس پروفایل" value="{{ auth()->user()->username }}" class="text-left"  />
                    <x-input type="text" name="telegram" placeholder="ایدی شما در تلگرام جهت دریافت نوتیفیکیشن" value="{{ auth()->user()->telegram }}" class="text-left"  />
                <p class="input-help text-left margin-bottom-12" dir="ltr">
                    <a href="{{ auth()->user()->profilePath() }}">{{ auth()->user()->profilePath() }}</a>
                </p>
                <x-input type="text" name="headline" placeholder="عنوان" value="{{ auth()->user()->headline }}" />
                <x-textarea placeholder="بیو" name="bio" value="{{ auth()->user()->bio }}" />
                @endcan
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی پروفایل</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
    <script >
        @include('Common::layouts.feedbacks')
    </script>
@endsection
