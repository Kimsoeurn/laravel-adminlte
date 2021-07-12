@props([
    'name' => ''
])
<input wire:model.lazy="{{ $name }}" name="{{ $name }}" id="{{ $name }}"
    {{ $attributes->merge(['class' => $errors->has($name) ? 'form-control is-invalid' : 'form-control']) }}>
