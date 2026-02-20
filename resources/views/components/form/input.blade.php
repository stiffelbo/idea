@props([
    'label' => '',
    'name',
    'type' => 'text',
    'id' => null,
    'value' => null,
    'placeholder' => ''
])

@php
    $inputId = $id ?? $name;
    $isFileInput = $type === 'file';
    $hasError = $errors->has($name);
    $errorMessage = $errors->first($name);
@endphp

<div class="space-y-2">
    @if($label !== '')
        <label for="{{ $inputId }}" class="label">
            {{ $label }}
        </label>
    @endif

    @if($type === 'textarea')
        <textarea
            id="{{ $inputId }}"
            name="{{ $name }}"
            class="textarea"
            @if ($placeholder !== '') placeholder="{{ $placeholder }}" @endif
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
             {{ $attributes->class([
                // stan błędu
                'border-error focus:border-error focus:ring-error/30' => $hasError,
            ]) }}
        >{{old($name, $value)}}</textarea>
    @else
        <input
            id="{{ $inputId }}"
            name="{{ $name }}"
            type="{{ $type }}"
            @if (! $isFileInput) value="{{ old($name, $value) }}" @endif
            @if ($placeholder !== '') placeholder="{{ $placeholder }}" @endif
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            @if($hasError) aria-describedby="{{ $inputId }}-error" @endif

            {{ $attributes->class([
                'input',
                // stan błędu
                'border-error focus:border-error focus:ring-error/30' => $hasError,
            ]) }}
        >
    @endif
    @if($hasError)
        <p id="{{ $inputId }}-error" class="text-sm text-error">
            {{ $errorMessage }}
        </p>
    @endif
</div>
