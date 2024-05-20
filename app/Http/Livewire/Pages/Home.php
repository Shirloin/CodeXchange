<?php

namespace App\Http\Livewire\Pages;

use App\Http\Controllers\Controller;
use Livewire\Component;

class Home extends Component
{
    public function create()
    {
        if (!auth()->check()) {
            Controller::FailMessage('Unauthenticated User');
            return;
        }
    }
    public function render()
    {
        return view('livewire.pages.home')->layout('layouts.template');
    }
}
