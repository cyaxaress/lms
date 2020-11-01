@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="جزییات دوره">جزییات دوره</a></li>
@endsection

@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 bg-white padding-30 margin-left-10 margin-bottom-15 border-radius-3">
            <div class="margin-bottom-20 flex-wrap font-size-14 d-flex bg-white padding-0">
                <p class="mlg-15">{{ $course->title }}</p>
                <a class="color-2b4a83" href="{{ route('lessons.create', $course->id) }}">آپلود جلسه جدید</a>
            </div>
            @can(\Cyaxaress\RolePermissions\Models\Permission::PERMISSION_MANAGE_COURSES)
            <div class="d-flex item-center flex-wrap margin-bottom-15 operations__btns">
                <button class="btn all-confirm-btn" onclick="acceptAllLessons('{{ route('lessons.acceptAll', $course->id) }}')">تایید همه جلسات</button>
                <button class="btn confirm-btn" onclick="acceptMultiple('{{ route('lessons.acceptMultiple', $course->id) }}')">تایید جلسات</button>
                <button class="btn reject-btn" onclick="rejectMultiple('{{ route('lessons.rejectMultiple', $course->id) }}')">رد جلسات</button>
                <button class="btn delete-btn" onclick="deleteMultiple('{{ route('lessons.destroyMultiple', $course->id) }}')">حذف جلسات</button>
            </div>
            @endcan
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th style="padding: 13px 30px;">
                            <label class="ui-checkbox">
                                <input type="checkbox" class="checkedAll">
                                <span class="checkmark"></span>
                            </label>
                        </th>
                        <th>شماره</th>
                        <th>عنوان جلسه</th>
                        <th>عنوان فصل</th>
                        <th>مدت زمان جلسه</th>
                        <th>وضعیت تایید</th>
                        <th>سطح دسترسی</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lessons as $lesson)
                        <tr role="row" class="" data-row-id="{{ $lesson->id }}">
                        <td>
                            <label class="ui-checkbox">
                                <input type="checkbox" class="sub-checkbox" data-id="{{ $lesson->id }}">
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <td><a href="">{{ $lesson->number }}</a></td>
                        <td><a href="">{{ $lesson->title}}</a></td>
                        <td>{{ $lesson->seasson ? $lesson->season->title : '-' }}</td>
                        <td>{{ $lesson->time }} دقیقه </td>
                        <td class="confirmation_status">
                                <span class="{{ $lesson->getConfirmationStatusCssClass() }}">
                                    @lang($lesson->confirmation_status)
                                </span>
                        </td>
                        <td class="status">
                            @if($lesson->status == \Cyaxaress\Course\Models\Lesson::STATUS_OPENED)
                                {{ $lesson->free ? 'همه'  : 'شرکت کنندگان'}}
                            @else
                                <span>قفل شده</span>
                            @endif
                        </td>
                        <td>
                            @can(\Cyaxaress\RolePermissions\Models\Permission::PERMISSION_MANAGE_COURSES)
                                <a href=""  onclick="deleteItem(event, '{{ route('lessons.destroy',[$course->id ,$lesson->id]) }}')"
                                   class="item-delete mlg-15" title="حذف"></a>
                                <a href="" onclick="updateConfirmationStatus(event, '{{ route('lessons.accept', $lesson->id) }}',
                                    'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')"
                                   class="item-confirm mlg-15" title="تایید"></a>
                                <a href="" onclick="updateConfirmationStatus(event, '{{ route('lessons.reject', $lesson->id) }}',
                                    'آیا از رد این آیتم اطمینان دارید؟' ,'رد شده')"
                                   class="item-reject mlg-15" title="رد"></a>
                                @if($lesson->status == \Cyaxaress\Course\Models\Lesson::STATUS_OPENED)
                                    <a href="" onclick="updateConfirmationStatus(event, '{{ route('lessons.lock', $lesson->id) }}',
                                        'آیا از قفل کردن این آیتم اطمینان دارید؟' , 'قفل شده', 'status')"
                                       class="item-lock text-error mlg-15" title="قفل کردن"></a>
                                @else
                                    <a href="" onclick="updateConfirmationStatus(event, '{{ route('lessons.unlock', $lesson->id) }}',
                                        'آیا از باز کردن این آیتم اطمینان دارید؟' , 'باز', 'status')"
                                       class="item-lock mlg-15 text-success" title="باز کردن"></a>
                                @endif
                            @endcan
                            <a href="{{ route('lessons.edit', [$course->id, $lesson->id]) }}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4">
            @include('Courses::seasons.index')

            <div class="col-12 bg-white margin-bottom-15 border-radius-3">
                <p class="box__title">اضافه کردن دانشجو به دوره</p>
                <form action="" method="post" class="padding-30">
                    <select name="" id="">
                        <option value="0">انتخاب کاربر</option>
                        <option value="1">mohammadniko3@gmail.com</option>
                        <option value="2">sayad@gamil.com</option>
                    </select><div class="dropdown-select wide" tabindex="0"><span class="current">mohammadniko3@gmail.com</span><div class="list"><div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div><ul><li class="option" data-value="0" data-display-text="">انتخاب کاربر</li><li class="option selected" data-value="1" data-display-text="">mohammadniko3@gmail.com</li><li class="option " data-value="2" data-display-text="">sayad@gamil.com</li></ul></div></div>
                    <input type="text" placeholder="مبلغ دوره" class="text">
                    <p class="box__title">کارمزد مدرس ثبت شود ؟</p>
                    <div class="notificationGroup">
                        <input id="course-detial-field-1" name="course-detial-field" type="radio" checked="">
                        <label for="course-detial-field-1">بله</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="course-detial-field-2" name="course-detial-field" type="radio">
                        <label for="course-detial-field-2">خیر</label>
                    </div>
                    <button class="btn btn-webamooz_net">اضافه کردن</button>
                </form>
                <div class="table__box padding-30">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th class="p-r-90">شناسه</th>
                            <th>نام و نام خانوادگی</th>
                            <th>ایمیل</th>
                            <th>مبلغ (تومان)</th>
                            <th>درامد شما</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr role="row" class="">
                            <td><a href="">1</a></td>
                            <td><a href="">توفیق حمزه ای</a></td>
                            <td><a href="">Mohammadniko3@gmail.com</a></td>
                            <td><a href="">40000</a></td>
                            <td><a href="">20000</a></td>
                            <td>
                                <a href="" class="item-delete mlg-15" title="حذف"></a>
                                <a href="" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @include('Common::layouts.feedbacks')
    </script>
@endsection
