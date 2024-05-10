<?php

namespace App\Http\Livewire\Components\Home;

use App\Models\Post;
use Livewire\Component;

class Solved extends Component
{
    public $posts;
    public function mount()
    {
        $this->posts = Post::with(['topics', 'replies', 'user'])
            ->where('is_solved', true)
            ->get();
    }
    public function render()
    {
        return view('livewire.components.home.solved');
    }
}
