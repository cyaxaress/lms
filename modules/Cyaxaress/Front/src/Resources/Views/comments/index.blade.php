<div class="container">
    <div class="comments">
        @include("Front::comments.create")

        <div class="comments-list">
            @include("Front::comments.reply")
            @foreach($commentable->approvedComments as $comment)
                <ul class="comment-list-ul">
                    <div class="div-btn-answer">
                        <button class="btn-answer">پاسخ به دیدگاه</button>
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
{{--
                    <li class="is-answer">
                        <div class="comment-header">
                            <div class="comment-header-avatar">
                                <img src="img/laravel-pic.png">
                            </div>
                            <div class="comment-header-detail">
                                <div class="comment-header-name">مدیر سایت : محمد نیکو</div>
                                <div class="comment-header-date">10 روز پیش</div>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                            </p>
                        </div>
                    </li>
                    <li class="is-comment">
                        <div class="comment-header">
                            <div class="comment-header-avatar">
                                <img src="img/profile.jpg">
                            </div>
                            <div class="comment-header-detail">
                                <div class="comment-header-name">کاربر : گوگل</div>
                                <div class="comment-header-date">10 روز پیش</div>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                            </p>
                        </div>
                    </li>
                    --}}
                </ul>
            @endforeach
        </div>
    </div>
</div>
