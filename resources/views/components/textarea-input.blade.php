@props(['id', 'name', 'value' => null, 'required' => false, 'autofocus' => false])

<textarea
    id="{{ $id }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
    @if ($required) required @endif
    @if ($autofocus) autofocus @endif
>{{ $value }}</textarea>

@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
