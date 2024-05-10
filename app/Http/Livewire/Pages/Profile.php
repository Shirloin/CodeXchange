<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Illuminate\Http\Client\Request;
use Livewire\Component;

class Profile extends Component
{

    public $user;

    public function mount($id)
    {
        $this->user = User::find($id);
    }

    public function render()
    {
        return view('livewire.pages.profile')->layout('layouts.template');
    }
}
