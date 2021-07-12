<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Language extends Component
{
    public function update($lang)
    {
        auth()->user()->update(['language' => $lang]);

        $url = session()->get('_previous') ? session()->get('_previous')['url'] : route('dashboard');

        redirect()->to($url);
    }

    public function render()
    {
        return view('livewire.users.language');
    }
}
