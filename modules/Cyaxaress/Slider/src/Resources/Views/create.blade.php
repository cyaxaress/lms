<p class="box__title">ایجاد اسلاید جدید</p>
<form action="{{ route('slides.store') }}" method="post" class="padding-30" enctype="multipart/form-data">
    @csrf
    <x-input type="file" name="image" required placeholder="تصویر" class="text" />
    <x-input type="number" name="priority" placeholder="الویت" class="text" />
    <x-input type="text" name="link"  placeholder="لینک" class="text" />
    <p class="box__title margin-bottom-15">وضعیت نمایش</p>
    <select name="status" id="status">
        <option value="1" selected>فعال</option>
        <option value="0" >غیرفعال</option>
    </select>
    <button class="btn btn-webamooz_net">اضافه کردن</button>
</form>
