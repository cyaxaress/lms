@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ویرایش کاربر">ویرایش کاربر</a></li>
@endsection
@section('content')
    <div class="row no-gutters margin-bottom-20">
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
                <x-select name="status" required>
                    <option value="">وضعیت حساب</option>
                    @foreach(\Cyaxaress\User\Models\User::$statuses as $status)
                        <option value="{{ $status }}"
                                @if($status == $user->status) selected @endif
                        >@lang($status)</option>
                    @endforeach
                </x-select>
                <x-select name="role" >
                    <option value="">یک نقش کاربری انتخاب کنید</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>@lang($role->name)</option>
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
    <div class="row no-gutters">
        <div class="col-6 margin-left-10 margin-bottom-20">
            <p class="box__title">درحال یادگیری</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام دوره</th>
                        <th>نام مدرس</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr role="row" class="">
                        <td><a href="">1</a></td>
                        <td><a href="">دوره لاراول</a></td>
                        <td><a href="">صیاد اعظمی</a></td>
                    </tr>
                    <tr role="row" class="">
                        <td><a href="">1</a></td>
                        <td><a href="">دوره لاراول</a></td>
                        <td><a href="">صیاد اعظمی</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6 margin-bottom-20">
            <p class="box__title">دوره های مدرس</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام دوره</th>
                        <th>نام مدرس</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->courses as $course)
                        <tr role="row" class="">
                            <td><a href="">{{ $course->id }}</a></td>
                            <td><a href="">{{ $course->title }}</a></td>
                            <td><a href="">{{ $course->teacher->name }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
    <script >
        @include('Common::layouts.feedbacks')
    </script>
@endsection
