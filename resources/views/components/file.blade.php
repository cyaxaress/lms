<div class="file-upload">
    <div class="i-file-upload">
        <span>{{ $placeholder }}</span>
        <input type="file" class="file-upload" id="files" name="{{ $name }}" {{ $attributes }}/>
    </div>
    <span class="filesize"></span>
    @if(isset($value))
        <p class="selectedFiles">
            <p>تصویر فعلی: <strong>{{ $value->filename }}</strong></p>
            <img src="{{ $value->thumb }}" width="150" alt="" class="margin-15 mt-2">
        </p>
    @else
        <span class="selectedFiles">فایلی انتخاب نشده است</span>
    @endif
    <x-validation-error field="{{ $name }}"/>
</div>
