<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class ShowForm extends Component
{
    public User $user;
    public $name;
    public $role_id;

    protected $rules = [
        'name' => 'required',
        'role_id' => 'nullable',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->role_id = $user->role_id;
    }

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {

        $data = $this->validate();
        $data['role_id'] = !empty($data['role_id']) ? $data['role_id'] : null;

        $this->user->syncRoles($this->role_id);

        $this->user->update($data);

        session()->flash('message', __('Updated'));
    }
//    public function mount(User $user)
//    {
//        $this->name = $user->name;
//    }
    public function render()
    {
        $roles = Role::query()->get();

        return view('livewire.users.show-form', ['roles' => $roles]);
    }
}
