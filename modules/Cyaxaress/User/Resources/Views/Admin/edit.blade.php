@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ویرایش کاربر">ویرایش کاربر</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی کاربر</p>
            <form action="{{ route('users.update', $user->id) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input name="name" placeholder="نام کاربر" type="text" value="{{ $user->name }}" required/>
                <x-input type="text" name="email" placeholder="ایمیل" value="{{ $user->email }}" class="text-left" required />
                <x-input type="text" name="username" placeholder="نام کاربری" value="{{ $user->username }}" class="text-left"  />
                <x-input type="text" name="mobile" placeholder="موبایل" value="{{ $user->mobile }}" class="text-left"  />
                <x-input type="text" name="headline" placeholder="عنوان" value="{{ $user->headline }}" class="text-left"  />
                <x-input type="text" name="website" placeholder="وب سایت" value="{{ $user->website }}" class="text-left"  />
                <x-input type="text" name="linkedin" placeholder="لینکداین" value="{{ $user->linkedin }}" class="text-left"  />
                <x-input type="text" name="facebook" placeholder="فیسبوک" value="{{ $user->facebook }}" class="text-left"  />
                <x-input type="text" name="twitter" placeholder="توییتر" value="{{ $user->twitter }}" class="text-left"  />
                <x-input type="text" name="youtube" placeholder="یوتیوب" value="{{ $user->youtube }}" class="text-left"  />
                <x-input type="text" name="instagram" placeholder="اینستاگرام" value="{{ $user->instagram }}" class="text-left"  />

                <x-select name="status" required>
                    <option value="">وضعیت حساب</option>
                    @foreach(\Cyaxaress\User\Models\User::$statuses as $status)
                        <option value="{{ $status }}"
                                @if($status == $user->status) selected @endif
                        >@lang($status)</option>
                    @endforeach
                </x-select>

                <x-file placeholder="آپلود بنر کاربر" name="image" :value="$user->image"/>
                <x-input type="password" name="password" placeholder="پسورد جدید" value=""  />
                <x-textarea placeholder="بیو" name="bio" value="{{ $user->bio }}" />
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی کاربر</button>
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
