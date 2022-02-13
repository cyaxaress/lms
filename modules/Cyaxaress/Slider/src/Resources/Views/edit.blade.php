@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('slides.index') }}" title="اسلاید ها">اسلاید ها</a></li>
    <li><a href="#" title="ویرایش اسلاید">ویرایش اسلاید</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-6 bg-white">
        <p class="box__title">بروزرسانی اسلاید</p>
        <form action="{{ route('slides.update', $slide->id) }}" method="post" class="padding-30" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <img src="{{ $slide->media->thumb }}" alt="" width="80">
            <x-input type="file" name="image" placeholder="تصویر" class="text" />
            <x-input type="number" name="priority" placeholder="الویت" class="text" value="{{ $slide->priority }}"/>
            <x-input type="text" name="link"  placeholder="لینک" class="text" value="{{ $slide->link }}"/>
            <p class="box__title margin-bottom-15">وضعیت نمایش</p>
            <select name="status" id="status">
                <option value="1" {{ $slide->status==1 ? "selected" : "" }}>فعال</option>
                <option value="0" {{ $slide->status==0 ? "selected" : "" }}>غیرفعال</option>
            </select>

            <button class="btn btn-webamooz_net">بروزرسانی</button>
        </form>
        </div>
    </div>
@endsection
