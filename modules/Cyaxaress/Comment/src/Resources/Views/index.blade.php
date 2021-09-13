@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('comments.index') }}" title="نظرات">نظرات</a></li>
@endsection
@section('content')
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item {{ request("status") == "" ? "is-active" : "" }}" href="{{ route("comments.index") }}?status="> همه نظرات</a>
            <a class="tab__item {{ request("status") == "new" ? "is-active" : "" }}" href="{{ route("comments.index") }}?status=new">نظرات تاییده نشده</a>
            <a class="tab__item {{ request("status") == "rejected" ? "is-active" : "" }}" href="{{ route("comments.index") }}?status=rejected">نظرات رد شده</a>
            <a class="tab__item {{ request("status") == "approved" ? "is-active" : "" }}" href="{{ route("comments.index") }}?status=approved">نظرات تاییده شده</a>
        </div>
    </div>
    <div class="bg-white padding-20">
        <div class="t-header-search">
            <form action="">
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی در نظرات">
                    <div class="t-header-search-content ">
                        <input type="text"  class="text" name="body"  placeholder="قسمتی از متن">
                        <input type="text"  class="text" name="email"  placeholder="ایمیل">
                        <input type="text"  class="text margin-bottom-20" name="name"  placeholder="نام و نام خانوادگی">
                        <button type="submit" class="btn btn-webamooz_net">جستجو</button>
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
                <td class="confirmation_status {{ $comment->getStatusCssClass() }}">@lang($comment->status)</td>
                <td>
                    <a href="{{ route("comments.show", $comment->id) }}" class="item-eye mlg-15" title="مشاهده"></a>
                    @if(auth()->user()->hasAnyPermission(
                        \Cyaxaress\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN,
                        \Cyaxaress\RolePermissions\Models\Permission::PERMISSION_MANAGE_COMMENTS))
                    <a href="" onclick="deleteItem(event, '{{ route('comments.destroy', $comment->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                    <a href="" onclick="updateConfirmationStatus(event, '{{ route('comments.accept', $comment->id) }}',
                        'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')"
                       class="item-confirm mlg-15" title="تایید"></a>
                    <a href="" onclick="updateConfirmationStatus(event, '{{ route('comments.reject', $comment->id) }}',
                        'آیا از رد این آیتم اطمینان دارید؟' ,'رد شده')"
                       class="item-reject mlg-15" title="رد"></a>
                    @endif
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
