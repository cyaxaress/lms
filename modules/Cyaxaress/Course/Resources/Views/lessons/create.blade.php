@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش درس">ایجاد درس</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">ایجاد درس جدید</p>
            <form action="{{ route('courses.store') }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                <x-input name="title" placeholder="عنوان درس" type="text" required/>
                <x-input type="text" name="slug" placeholder="نام انگلیسی درس اختیاری" class="text-left" required />

                <x-select name="season_id" required>
                    <option value="">انتخاب سرفصل درس</option>
                    @foreach($seasons as $season)
                    <option value="{{ $season->id }}" @if($season->id == old('season_id')) selected @endif>{{ $season->title }}</option>
                    @endforeach
                </x-select>

                <div class="w-50">
                    <p class="box__title">ایا این درس رایگان است ؟ </p>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-1" name="free" value="0" type="radio" checked="">
                        <label for="lesson-upload-field-1">خیر</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-2" name="free" value="1" type="radio">
                        <label for="lesson-upload-field-2">بله</label>
                    </div>
                </div>
                <x-file placeholder="آپلود درس" name="lesson_file" required />
                <x-textarea placeholder="توضیحات درس" name="body" />
                <br>
                <button class="btn btn-webamooz_net">ایجاد درس</button>
            </form>
        </div>
    </div>
@endsection
