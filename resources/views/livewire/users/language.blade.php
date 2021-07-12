<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="flag-icon {{ auth()->user()->language == 'kh' ? 'flag-icon-kh' : 'flag-icon-us' }}"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right p-0">
        <a wire:click.prevent="update('kh')" href="" class="dropdown-item {{ auth()->user()->language == 'kh' ? 'disabled' : '' }}" id="khmer">
            <i class="flag-icon flag-icon-kh mr-2"></i> {{ __('Khmer') }}
        </a>
        <a wire:click.prevent="update('en')" href="" class="dropdown-item {{ auth()->user()->language == 'en' ? 'disabled' : '' }}" id="english">
            <i class="flag-icon flag-icon-us mr-2"></i> {{ __('English') }}
        </a>
    </div>
</li>
