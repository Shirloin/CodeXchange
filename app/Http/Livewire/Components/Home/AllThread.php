<?php

namespace App\Http\Livewire\Components\Home;

use App\Models\Post;
use Livewire\Component;

class AllThread extends Component
{
    public $posts;
    public function mount()
    {
        $this->posts = Post::with(['topics', 'replies', 'user'])->get();
    }
    public function render()
    {
        return view('livewire.components.home.all-thread');
    }
}
