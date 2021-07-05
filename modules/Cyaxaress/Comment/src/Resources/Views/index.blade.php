@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('comments.index') }}" title="نظرات">نظرات</a></li>
@endsection
@section('content')
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item is-active" href="comments.html"> همه نظرات</a>
            <a class="tab__item " href="comments.html">نظرات تاییده نشده</a>
            <a class="tab__item " href="comments.html">نظرات تاییده شده</a>
        </div>
    </div>
    <div class="bg-white padding-20">
        <div class="t-header-search">
            <form action="" onclick="event.preventDefault();">
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی در نظرات">
                    <div class="t-header-search-content ">
                        <input type="text"  class="text"  placeholder="قسمتی از متن">
                        <input type="text"  class="text"  placeholder="ایمیل">
                        <input type="text"  class="text margin-bottom-20"  placeholder="نام و نام خانوادگی">
                        <button class="btn btn-webamooz_net">جستجو</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>شناسه</th>
                <th>ارسال کننده</th>
                <th>برای</th>
                <th>دیدگاه</th>
                <th>تاریخ</th>
                <th>تعداد پاسخ ها</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
            <tr role="row" >
                <td><a href="">{{ $comment->id }}</a></td>
                <td><a href="">{{ $comment->user->name }}</a></td>
                <td><a href="{{ $comment->commentable->path() }}">{{ $comment->commentable->title }}</a></td>
                <td>{{ $comment->body }}</td>
                <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($comment->created_at) }}</td>
                <td>{{ $comment->comments()->count() }} ({{ $comment->not_approved_comments_count }})</td>
                <td class="{{ $comment->getStatusCssClass() }}">@lang($comment->status)</td>
                <td>
                    <a href="" onclick="deleteItem(event, '{{ route('comments.destroy', $comment->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                    <a href="show-comment.html"  class="item-reject mlg-15" title="رد"></a>
                    <a href="show-comment.html" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                    <a href="show-comment.html"  class="item-confirm mlg-15" title="تایید"></a>
                    <a href="edit-comment.html" class="item-edit " title="ویرایش"></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script>
        @include('Common::layouts.feedbacks')
    </script>
@endsection
