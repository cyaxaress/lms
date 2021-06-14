<div class="comment-main">
    <div class="ct-header">
        <h3>نظرات ( 180 )</h3>
        <p>نظر خود را در مورد این مقاله مطرح کنید</p>
    </div>
    <form action="{{ route("comments.store") }}" method="post">
        @csrf
        <input type="hidden" name="commentable_type" value="{{ get_class($commentable) }}">
        <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">
        <div class="ct-row">
            <div class="ct-textarea">
                <x-textarea name="body" placeholder="ارسال نظر..."/>
            </div>
        </div>
        <div class="ct-row">
            <div class="send-comment">
                <button type="submit" class="btn i-t">ثبت نظر</button>
            </div>
        </div>
    </form>
</div>
