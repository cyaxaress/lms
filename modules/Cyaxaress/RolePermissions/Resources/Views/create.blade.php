<p class="box__title">ایجاد نقش کاربری جدید</p>
<form action="{{ route('categories.store') }}" method="post" class="padding-30">
    @csrf
    <input type="text" name="title" required placeholder="نام دسته بندی" class="text">
    <p class="box__title margin-bottom-15">انتخاب مجوزها</p>

    <button class="btn btn-webamooz_net">اضافه کردن</button>
</form>
