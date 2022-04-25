<div>
    <select name="{{ config('tag.key') }}[]" {{ $attributes }} dir="rtl" multiple>
        @foreach($tags as $tag)
            <option @if($attributes->has('selected_tags') && $attributes->get('selected_tags')->contains($tag->id)) selected @endif>{{ $tag->title }}</option>
        @endforeach
    </select>
    <x-validation-error field="{{ config('tag.key') }}"/>
</div>
