<?php

namespace App\Http\Livewire\Components\Home;

use App\Models\Post;
use Livewire\Component;

class Unsolved extends Component
{
    public $posts;
    public function mount()
    {
        $this->posts = Post::with(['topic', 'replies', 'user'])
            ->where('is_solved', false)
            ->get();
    }
    public function render()
    {
        return view('livewire.components.home.unsolved');
    }
}
