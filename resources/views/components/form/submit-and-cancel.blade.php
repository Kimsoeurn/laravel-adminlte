@props([
    'url' => ''
])
<a href="{{ $url }}" class="btn btn-secondary"><i class="fa fa-times-circle"></i> {{ __('Cancel') }}</a>
<button wire:loading.attr="disabled" type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> {{ __('Save') }}</button>
<x-form.flash/>
