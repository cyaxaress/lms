@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
    <li><a href="{{ route('courses.details', $course->id) }}" title="{{ $course->title }}">{{ $course->title }}</a></li>
    <li><a href="#" title="ویرایش درس">بروزرسانی درس</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">ایجاد درس جدید</p>
            <form action="{{ route('lessons.update', [$course->id, $lesson->id ]) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input name="title" placeholder="عنوان درس *" type="text" value="{{ $lesson->title }}" required/>
                <x-input type="text" name="slug" placeholder="نام انگلیسی درس اختیاری" class="text-left" value="{{ $lesson->slug }}" />
                <x-input type="number" name="time" placeholder="مدت زمان جلسه *" class="text-left" value="{{ $lesson->time }}" required />
                <x-input type="number" name="number" placeholder="شماره جلسه" class="text-left" value="{{ $lesson->number }}"/>

                @if(count($seasons))
                    <x-select name="season_id" required>
                        <option value="">انتخاب سرفصل درس *</option>
                        @foreach($seasons as $season)
                        <option value="{{ $season->id }}" @if($season->id == $lesson->season_id) selected @endif>{{ $season->title }}</option>
                        @endforeach
                    </x-select>
                @endif

                <div class="w-50">
                    <p class="box__title">ایا این درس رایگان است ؟ * </p>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-1" name="is_free" value="0" type="radio" @if(! $lesson->is_free) checked="" @endif>
                        <label for="lesson-upload-field-1">خیر</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-2" name="is_free" value="1" type="radio" @if($lesson->is_free) checked="" @endif>
                        <label for="lesson-upload-field-2">بله</label>
                    </div>
                </div>
                <x-file placeholder="آپلود درس *" name="lesson_file" :value="$lesson->media" />
                <x-textarea placeholder="توضیحات درس" name="body" value="{{ $lesson->body }}" />
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی درس</button>
            </form>
        </div>
    </div>
@endsection
