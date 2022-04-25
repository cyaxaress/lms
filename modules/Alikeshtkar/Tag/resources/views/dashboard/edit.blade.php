@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('tags.index') }}" title="برچسب‌ها">برچسب‌ها</a></li>
    <li><a href="#" title="ویرایش برچسب">ویرایش برچسب</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-6 bg-white">
        <p class="box__title">بروزرسانی برچسب</p>
        <form action="{{ route('tags.update', $tag->id) }}" method="post" class="padding-30">
            @csrf
            @method('patch')
            <x-input name="title" placeholder="عنوان برچسب" value="{{ $tag->title }}" type="text" required/>
            <button class="btn btn-webamooz_net">بروزرسانی</button>
        </form>
        </div>
    </div>
@endsection
