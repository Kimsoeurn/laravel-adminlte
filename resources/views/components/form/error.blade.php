@props(['key' => ''])
@error($key)
<span class="invalid-feedback" role="alert">
    {{ $message }}
</span>
@enderror
