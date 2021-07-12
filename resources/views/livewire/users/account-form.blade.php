<div class="card">
    <div class="card-header">
        <i class="fa fa-user"></i> {{ __('User Account') }}
    </div>
    <form wire:submit.prevent="save" method="POST">
        @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
            <x-form.input type="email" name="email"/>
            <x-form.error key="email"/>
        </div>
        <div class="form-group">
            <label for="password">{{ __('Password') }} <span class="text-danger">*</span></label>
            <x-form.input type="password" name="password"/>
            <x-form.error key="password"/>
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ __('Password Confirm') }} <span class="text-danger">*</span></label>
            <x-form.input type="password" name="password_confirmation"/>
            <x-form.error key="password_confirmation"/>
        </div>
    </div>
    @canany(['edit_users', 'change_own_account'])
    <div class="card-footer">
        <x-form.submit-and-cancel url="{{ route('users.index') }}"/>
    </div>
    @endcanany
    </form>
</div>
