@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره">ویرایش دوره</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی دوره</p>
            <form action="{{ route('courses.store') }}" class="padding-30">
                @csrf
                <input type="text" class="text" name="title" placeholder="عنوان دوره" required>
                <input type="text" class="text text-left " name="slug" placeholder="نام انگلیسی دوره" required>

                <div class="d-flex multi-text">
                    <input type="text" class="text text-left mlg-15" name="priority" placeholder="ردیف دوره">
                    <input type="text" placeholder="مبلغ دوره" name="price" class="text-left text mlg-15" required>
                    <input type="number" placeholder="درصد مدرس" name="percent" class="text-left text" required>
                </div>
                <select name="teacher_id" required>
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
                <ul class="tags">
                    <li class="tagAdd taglist">
                        <input type="text" name="tags" id="search-field" placeholder="برچسب ها">
                    </li>
                </ul>
                <select name="type" required>
                    <option value="">نوع دوره</option>
                    <option value="cash">نقدی</option>
                    <option value="free">رایگان</option>
                </select>
                <select name="status" required>
                    <option value="">وضعیت دوره</option>
                    <option value="not-completed">درحال برگزاری</option>
                    <option value="completed">تکمیل</option>
                    <option value="lock">قفل شده</option>
                </select>
                <select name="category_id" required>
                    <option value="">دسته بندی</option>
                    @foreach($categories  as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                <div class="file-upload">
                    <div class="i-file-upload">
                        <span>آپلود بنر دوره</span>
                        <input type="file" class="file-upload" id="files" name="attachment" required/>
                    </div>
                    <span class="filesize"></span>
                    <span class="selectedFiles">فایلی انتخاب نشده است</span>
                </div>
                <textarea placeholder="توضیحات دوره" name="body" class="text h"></textarea>
                <button class="btn btn-webamooz_net">ایجاد دوره</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
