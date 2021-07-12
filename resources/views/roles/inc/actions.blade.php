@if ($role->id != 1 && $role->name != 'Super Admin')
    @can('edit_roles')
        <a class="btn btn-light btn-sm text-info" href="{{ route('roles.edit', $role->id) }}" title="{{ __('app.edit') }}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    @can('delete_roles')
        <a class="btn btn-light text-danger btn-sm btn-delete"
           data-alert-title="{{ __('Delete Message', ['attribute' => $role->name]) }}"
           data-confirm="{{ __('Confirm') }}"
           data-cancel="{{ __('Cancel') }}"
           title="{{ __('Delete') }}"
           href="{{ route('roles.destroy', $role->id) }}">
            <i class="fas fa-trash"></i>
        </a>
    @endcan
@endif

