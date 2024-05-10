<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Navbar extends Component
{
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
    public function render()
    {
        return view('livewire.components.navbar');
    }
}
