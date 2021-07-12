<div class="card">
    <div class="card-header">
        <i class="fa fa-plus"></i> {{ __('Create') }}
    </div>
    <form wire:submit.prevent="save" method="POST">
        @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
            <x-form.input name="name"/>
            <x-form.error key="name"/>
        </div>
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
        <div class="form-group">
            <label for="role">{{ __('Role') }}</label>
            <select wire:model.lazy="role_id" name="role" id="role" class="form-control">
                <option value="">{{ __('Role') }}</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }} @if(count($role->permissions)) ({{ count($role->permissions) }}) @endif</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-footer">
        <x-form.submit-and-cancel url="{{ route('users.index') }}" />
    </div>
    </form>
</div>
