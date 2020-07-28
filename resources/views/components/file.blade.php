<div class="file-upload">
    <div class="i-file-upload">
        <span>{{ $placeholder }}</span>
        <input type="file" class="file-upload" id="files" name="{{ $name }}" required/>
    </div>
    <span class="filesize"></span>
    <span class="selectedFiles">فایلی انتخاب نشده است</span>
    <x-validation-error field="{{ $name }}"/>
</div>
