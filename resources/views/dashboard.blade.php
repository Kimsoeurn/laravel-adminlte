<x-admin-layout :title="$title" :spin-logo="true" active-route="{{$activeRoute ?? ''}}">
    <x-slot name="header">
        <x-admin-content-header :title="$title" :breadcrumb="$breadcrumb"/>
    </x-slot>
    <x-form.flash-top-header/>
    <div class="card">
    </div>
</x-admin-layout>
