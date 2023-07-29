@props(['id', 'name', 'accept', 'required' => false])

<input type="file"
    id="{{ $id }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'custom-file-input ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
    @if ($accept) accept="{{ $accept }}" @endif
    @if ($required) required @endif
>

@error($name)
    <strong>{{ $message }}</strong>
@enderror
