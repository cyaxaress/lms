@if(isset($tags) && $tags->count())
    <div class="tags">
        <ul>
            @foreach($tags as $tag)
                <li>
                    <a href="{{ $tag->path() }}" target="_blank">{{ $tag->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
