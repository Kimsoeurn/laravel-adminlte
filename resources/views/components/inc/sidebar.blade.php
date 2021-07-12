@props([
    'activeRoute' => ''
])
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ route('dashboard') == $activeRoute ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    {{ __('Dashboard') }}
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>
        @canany(['show_users', 'show_roles'])
        <li class="nav-item @if(
                        $activeRoute == route('users.index') ||
                        $activeRoute == route('roles.index')
            ) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    System Setting
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('show_users')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ $activeRoute == route('users.index') ? 'active' : '' }}">
                        <i class="fa fa-circle nav-icon"></i>
                        <p>{{ __('Users') }}</p>
                    </a>
                </li>
                @endcan
                @can('show_roles')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link  {{ $activeRoute == route('roles.index') ? 'active' : '' }}">
                        <i class="fa fa-circle nav-icon"></i>
                        <p>{{ __('Role and Permissions') }}</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany
        <li class="nav-header">MISCELLANEOUS</li>
        <li class="nav-item">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                    {{ __('Logout') }}
                </p>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
        </li>
    </ul>
</nav>
