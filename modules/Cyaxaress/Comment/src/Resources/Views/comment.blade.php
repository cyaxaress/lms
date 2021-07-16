<div class="transition-comment {{ $isAnswer ? "is-answer" : "" }}">
    <div class="transition-comment-header">
       <span>
            <img src="{{ $comment->user->thumb }}" class="logo-pic" alt="{{ $comment->user->name }}">
       </span>
        <span class="nav-comment-status">
            <p class="username">کاربر : {{ $comment->user->name }}</p>
            <p class="comment-date">{{ $comment->created_at->diffForHumans() }}</p>
            <span class="confirmation_status {{ $comment->getStatusCssClass() }}">@lang($comment->status)</span>
        </span>
        @if($isAnswer)
            <div class="comment-actions">
                <a href=""
                   onclick="deleteItem(event, '{{ route('comments.destroy', $comment->id) }}', 'div.transition-comment')"
                   class="item-delete mlg-15" title="حذف"></a>
                <a href="" onclick="updateConfirmationStatus(event, '{{ route('comments.accept', $comment->id) }}',
                    'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده', 'confirmation_status', 'div.transition-comment-header', 'span.')"
                   class="item-confirm mlg-15" title="تایید"></a>
                <a href="" onclick="updateConfirmationStatus(event, '{{ route('comments.reject', $comment->id) }}',
                    'آیا از رد این آیتم اطمینان دارید؟' ,'رد شده', 'confirmation_status', 'div.transition-comment-header', 'span.')"
                   class="item-reject mlg-15" title="رد"></a>
            </div>
        @endif
    </div>
    <div class="transition-comment-body">
        <pre>{{ $comment->body }}</pre>
    </div>
</div>
