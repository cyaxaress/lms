<select name="{{ $name }}" {{ $attributes }}>
    {{ $slot }}
</select>
<x-validation-error field="{{ $name}}"/>
