<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateForm extends Component
{
    public User $user;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role_id;
    public $remark;

    protected $rules = [
        'name' => 'required',
        'email' => ['required','email','unique:users'],
        'password' => ['required','min:6', 'same:password_confirmation'],
        'role_id' => 'nullable',
        'remark' => 'nullable'
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'password_confirmation',
        'role_id'
    ];

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $data = $this->validate();

        $this->user->create($data);

        session()->flash('message', __('Created'));

        $this->reset($this->fillable);

    }

    public function render()
    {
        $roles = Role::query()->get();

        return view('livewire.users.create-form', [
            'roles' => $roles
        ]);
    }
}
