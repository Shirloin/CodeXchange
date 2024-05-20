<?php

namespace App\Http\Livewire\Pages;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Livewire\Component;

class Profile extends Component
{

    public $user;
    public $posts;
    public function mount($id)
    {
        $this->user = User::find($id);
        $this->posts = $this->user->posts()->getQuery()->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.pages.profile')->layout('components.layouts.template');
    }
}
