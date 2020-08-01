@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دسته بندی ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>ردیف</th>
                        <th>ای دی</th>
                        <th>بنر</th>
                        <th>عنوان</th>
                        <th>مدرس</th>
                        <th>قیمت</th>
                        <th>درصد مدرس</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                    <tr role="row" class="">
                        <td><a href="">{{ $course->priority }}</a></td>
                        <td><a href="">{{ $course->id }}</a></td>
                        <td width="80"><img src="{{ $course->thumb }}" alt="" width="80"></td>
                        <td><a href="">{{ $course->title }}</a></td>
                        <td><a href="">{{ $course->teacher->name }}</a></td>
                        <td>{{ $course->price }}</td>
                        <td>{{ $course->percent }}%</td>
                        <td>@lang($course->status)</td>
                        <td>
                            <a href="" onclick="deleteItem(event, '{{ route('courses.destroy', $course->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="{{ route('courses.edit',  $course->id) }}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
