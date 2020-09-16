@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="جزییات دوره">جزییات دوره</a></li>
@endsection

@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 bg-white padding-30 margin-left-10 margin-bottom-15 border-radius-3">
            <div class="margin-bottom-20 flex-wrap font-size-14 d-flex bg-white padding-0">
                <p class="mlg-15">دوره مقدماتی تا پیشرفته لاراول</p>
                <a class="color-2b4a83" href="lesson-upload.html">آپلود جلسه جدید</a>
            </div>
            <div class="d-flex item-center flex-wrap margin-bottom-15 operations__btns">
                <button class="btn all-confirm-btn">تایید همه جلسات</button>
                <button class="btn confirm-btn">تایید جلسات</button>
                <button class="btn reject-btn">رد جلسات</button>
                <button class="btn delete-btn">حذف جلسات</button>

            </div>
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
                        <th>شناسه</th>
                        <th>عنوان جلسه</th>
                        <th>عنوان فصل</th>
                        <th>مدت زمان جلسه</th>
                        <th>وضعیت تایید</th>
                        <th>سطح دسترسی</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr role="row" class="" data-row-id="1">
                        <td>
                            <label class="ui-checkbox">
                                <input type="checkbox" class="sub-checkbox" data-id="1">
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <td><a href="">1</a></td>
                        <td><a href="">دوره مقدماتی تا پیشرفته لاراول</a></td>
                        <td>بخش بک اند پروژه</td>
                        <td>12 دقیقه</td>
                        <td>تایید شده</td>
                        <td>همه</td>
                        <td>
                            <a href="" class="item-delete mlg-15" data-id="1" title="حذف"></a>
                            <a href="" class="item-reject mlg-15" title="رد"></a>
                            <a href="" class="item-lock mlg-15" title="قفل "></a>
                            <a href="" class="item-confirm mlg-15" title="تایید"></a>
                            <a href="" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>

                    <tr role="row" data-row-id="2">
                        <td>
                            <label class="ui-checkbox">
                                <input type="checkbox" class="sub-checkbox" data-id="2">
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <td><a href="">1</a></td>
                        <td><a href="">دوره مقدماتی تا پیشرفته لاراول</a></td>
                        <td>بخش بک اند پروژه</td>
                        <td>12 دقیقه</td>
                        <td>تایید شده</td>
                        <td>همه</td>
                        <td>
                            <a href="" class="item-delete mlg-15" title="حذف"></a>
                            <a href="" class="item-reject mlg-15" title="رد"></a>
                            <a href="" class="item-lock mlg-15" title="قفل "></a>
                            <a href="" class="item-confirm mlg-15" title="تایید"></a>
                            <a href="" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                    <tr role="row" data-row-id="3">
                        <td>
                            <label class="ui-checkbox">
                                <input type="checkbox" class="sub-checkbox" data-id="3">
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <td><a href="">1</a></td>
                        <td><a href="">دوره مقدماتی تا پیشرفته لاراول</a></td>
                        <td>بخش بک اند پروژه</td>
                        <td>12 دقیقه</td>
                        <td>تایید شده</td>
                        <td>شرکت کنندگان</td>
                        <td>
                            <a href="" class="item-delete mlg-15" data-id="2" title="حذف"></a>
                            <a href="" class="item-reject mlg-15" title="رد"></a>
                            <a href="" class="item-lock mlg-15" title="قفل "></a>
                            <a href="" class="item-confirm mlg-15" title="تایید"></a>
                            <a href="" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
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
