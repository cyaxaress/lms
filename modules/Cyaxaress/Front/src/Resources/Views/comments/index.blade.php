<div class="container">
    <div class="comments">
        @include("Front::comments.create", ["commentable" => $course])

        <div class="comments-list">
            @include("Front::comments.reply", ["commentable" => $course])
            @foreach($commentable->approvedComments as $comment)
                <ul class="comment-list-ul">
                    <div class="div-btn-answer">
                        <button class="btn-answer" onclick="setCommentId({{ $comment->id }})">پاسخ به دیدگاه</button>
                    </div>
                    <li class="is-comment">
                        <div class="comment-header">
                            <div class="comment-header-avatar">
                                <img src="{{ $comment->user->thumb }}" alt="{{ $comment->user->name }}">
                            </div>
                            <div class="comment-header-detail">
                                <div class="comment-header-name">کاربر : {{ $comment->user->name }}</div>
                                <div class="comment-header-date">{{ $comment->created_at }}</div>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>
                                {{ $comment->body }}
                            </p>
                        </div>
                    </li>
                    @foreach($comment->comments as $reply)
                        <li class="is-answer">
                            <div class="comment-header">
                                <div class="comment-header-avatar">
                                    <img src="{{ $reply->user->thumb }}">
                                </div>
                                <div class="comment-header-detail">
                                    <div class="comment-header-name">{{ $reply->user->name }}</div>
                                    <div class="comment-header-date">10 روز پیش</div>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p>
                                    {{ $reply->body }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</div>
