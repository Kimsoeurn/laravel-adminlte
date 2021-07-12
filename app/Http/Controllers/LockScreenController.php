<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LockScreenController extends Controller
{
    public function locked()
    {
        if(!session('lock-expires-at')){
            redirect()->route('dashboard');
        }

        if(session('lock-expires-at') > now()){
            redirect()->route('dashboard');
        }

        return view('auth.locked');
    }

    public function unlock(Request $request)
    {
        $check = \Hash::check($request->get('password'), $request->user()->password);

        if(! $check) {
            return redirect()->route('login.locked')->withError(__('Your password does not match your profile.'));
        }

        session(['lock-expires-at' => now()->addMinutes($request->user()->getLockoutTime())]);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
