<?php

namespace App\Http\Livewire\Pages;

use App\Http\Controllers\Controller;
use App\Models\Library as ModelsLibrary;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Library extends Component
{
    protected $listeners = [
        'refresh' => 'refresh'
    ];
    public $posts;
    public function mount()
    {
        $this->refresh();
    }
    public function refresh()
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            Controller::FailMessage('Unauthorize User');
            return;
        }
        $this->posts = $user->libraries()->get();
    }
    public function render()
    {
        return view('livewire.pages.library')->layout('layouts.template');
    }
}
