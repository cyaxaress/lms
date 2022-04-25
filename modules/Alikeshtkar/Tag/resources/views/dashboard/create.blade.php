<p class="box__title">ایجاد برچسب جدید</p>
<form action="{{ route('tags.store') }}" method="post" class="padding-30">
    @csrf
    <x-input name="title" placeholder="عنوان برچسب" type="text" required/>
    <button class="btn btn-webamooz_net">اضافه کردن</button>
</form>
