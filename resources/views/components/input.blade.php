<div class="w-100 mlg-15">
    <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
           {{ $attributes->merge(['class' => 'text w-100']) }}
           value="{{ old($name) }}"
    >
    <x-validation-error field='{{ str_replace("]", "", str_replace("[", ".", $name)) }}'/>
</div>
