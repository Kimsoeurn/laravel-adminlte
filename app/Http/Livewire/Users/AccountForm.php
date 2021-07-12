<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class AccountForm extends Component
{
    public $userID;
    public User $user;
    public $email;
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'email' => ['required','email','unique:users,email,'.$this->userID],
            'password' => ['required','min:6', 'same:password_confirmation'],
        ];
    }

    public function mount(User $user)
    {
        $this->email = $user->email;
        $this->userID = $user->id;
    }

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $data = $this->validate();

        $this->user->update($data);

        session()->flash('message', __('Updated'));
    }
    public function render()
    {
        return view('livewire.users.account-form');
    }
}
