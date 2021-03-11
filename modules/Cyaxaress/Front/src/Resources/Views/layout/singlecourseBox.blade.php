<div class="col">
    <a href="{{ $courseItem->path() }}">
        <div class="course-status">
            @lang($courseItem->status)
        </div>
        @if($courseItem->getDiscountPercent())
        <div class="discountBadge">
            <p>{{ $courseItem->getDiscountPercent() }}%</p>
            تخفیف
        </div>
        @endif
        <div class="card-img"><img src="{{ $courseItem->banner->thumb }}" alt="{{ $courseItem->title }}"></div>
        <div class="card-title"><h2>{{ $courseItem->title }}</h2></div>
        <div class="card-body">
            <img src="{{ $courseItem->teacher->thumb }}" alt="{{ $courseItem->teacher->name }}">
            <span>{{ $courseItem->teacher->name }}</span>
        </div>
        <div class="card-details">
            <div class="time">{{ $courseItem->formattedDuration() }}</div>
            <div class="price">
                @if($courseItem->getDiscountPercent())
                <div class="discountPrice">{{ $courseItem->getFormattedPrice() }}</div>
                @endif
                <div class="endPrice">{{ number_format($courseItem->getFinalPrice()) }}</div>
            </div>
        </div>
    </a>
</div>
