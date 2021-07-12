<x-admin-layout :title="$title" active-route="{{$activeRoute ?? ''}}">
    <x-slot name="header">
        <x-admin-content-header :title="$title" :breadcrumb="$breadcrumb"/>
    </x-slot>
    <div class="row">
        <div class="col-lg-6">
            <livewire:users.show-form :user="$user"/>
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info"></i> {{ __('Last login info') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">{{ __('IP') }}</label>
                            <input type="text" value="{{ $user->last_login_ip }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="name">{{ __('Date') }}</label>
                            <input type="text" value="{{ $user->last_login_time ? $user->last_login_time->format('d/m/Y H:i') : '' }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <livewire:users.account-form :user="$user"/>
        </div>
    </div>
</x-admin-layout>

