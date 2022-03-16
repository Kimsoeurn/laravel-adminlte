<?php

function crud_permission($name, $order = 0)
{
    return [
        ['name' => 'show_'.$name, 'group_name' => $name, 'guard_name' => 'web', 'group_order' => $order],
        ['name' => 'create_'.$name, 'group_name' => $name, 'guard_name' => 'web', 'group_order' => $order],
        ['name' => 'edit_'.$name, 'group_name' => $name, 'guard_name' => 'web', 'group_order' => $order],
        ['name' => 'delete_'.$name, 'group_name' => $name, 'guard_name' => 'web', 'group_order' => $order],
    ];
}

function role_name($id)
{
    $role = \Spatie\Permission\Models\Role::find($id);

    return $role->name ?? null;
}

function can($key)
{
    return auth()->user()->can($key);
}

function can_not($key)
{
    return ! auth()->user()->can($key);
}

function unauthorized()
{
    return redirect()->route('dashboard')
        ->withMessage(__('Unauthorized'))->withType('danger');
}
