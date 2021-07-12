<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Language extends Component
{
    public function khmer()
    {
        $user = User::find(auth()->user()->id);
        $user->language = 'kh';
        $user->save();

        redirect()->route('dashboard');
    }
    public function english()
    {
        $user = User::find(auth()->user()->id);
        $user->language = 'en';
        $user->save();

        redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.users.language');
    }
}
