@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره">ویرایش دوره</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی دوره</p>
            <form action="{{ route('courses.store') }}" class="padding-30" method="post">
                @csrf
                <x-input name="title" placeholder="عنوان دوره" type="text" required/>
                <x-input type="text" name="slug" placeholder="نام انگلیسی دوره" class="text-left" required />


                <div class="d-flex multi-text">
                    <x-input type="text" class="text-left mlg-15" name="priority" placeholder="ردیف دوره" />
                    <x-input type="text" placeholder="مبلغ دوره" name="price" class="text-left" required />
                    <x-input type="number" placeholder="درصد مدرس" name="percent" class="text-left" required />
                </div>
                <select name="teacher_id" required>
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
                <x-validation-error field="teacher_id"/>
                <ul class="tags">
                    <li class="tagAdd taglist">
                        <input type="text" name="tags" id="search-field" placeholder="برچسب ها">
                        <x-validation-error field="tags"/>
                    </li>
                </ul>
                <select name="type" required>
                    <option value="">نوع دوره</option>
                    @foreach(\Cyaxaress\Course\Models\Course::$types as $type)
                        <option value="{{ $type }}">@lang($type)</option>
                    @endforeach
                </select>
                <x-validation-error field="type"/>
                <select name="status" required>
                    <option value="">وضعیت دوره</option>
                    @foreach(\Cyaxaress\Course\Models\Course::$statuses as $status)
                        <option value="{{ $status }}">@lang($status)</option>
                    @endforeach
                </select>
                <select name="category_id" required>
                    <option value="">دسته بندی</option>
                    @foreach($categories  as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                <x-validation-error field="category_id"/>
                <div class="file-upload">
                    <div class="i-file-upload">
                        <span>آپلود بنر دوره</span>
                        <input type="file" class="file-upload" id="files" name="image" required/>
                    </div>
                    <span class="filesize"></span>
                    <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    <x-validation-error field="image"/>
                </div>
                <textarea placeholder="توضیحات دوره" name="body" class="text h"></textarea>
                <x-validation-error field="body"/>
                <button class="btn btn-webamooz_net">ایجاد دوره</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
