<div class="episodes-list">
    <div class="episodes-list--title">
        فهرست جلسات
        <span>دریافت همه لینک های دانلود</span>

    </div>
    <div class="episodes-list-section">
        @foreach($lessons as $lesson)
        <div class="episodes-list-item {{ auth()->user()->hasAccessToCourse($lesson->course) ? '' : 'lock' }}">
            <div class="section-right">
                <span class="episodes-list-number">{{ $lesson->number }}</span>
                <div class="episodes-list-title">
                    <a href="{{ $lesson->path() }}">{{ $lesson->title }}</a>
                </div>
            </div>
            <div class="section-left">
                <div class="episodes-list-details">
                    <div class="episodes-list-details">
                        <span class="detail-type">@lang($lesson->type)</span>
                        <span class="detail-time">{{ $lesson->time }} دقیقه</span>
                        <a class="detail-download">
                            <i class="icon-download"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
