@can('show_users')
<a href="{{ route('users.show', $user->id) }}" class="btn btn-sm"><i class="fa fa-th-list"></i></a>
@endcan
@can('delete_users')
<a class="btn btn-light text-danger btn-sm btn-delete"
   data-alert-title="{{ __('Delete Message', ['attribute' => $user->name]) }}"
   data-confirm="{{ __('Confirm') }}"
   data-cancel="{{ __('Cancel') }}"
   title="{{ __('Delete') }}"
   href="{{ route('users.destroy', $user->id) }}">
    <i class="fas fa-trash"></i>
</a>
@endcan
