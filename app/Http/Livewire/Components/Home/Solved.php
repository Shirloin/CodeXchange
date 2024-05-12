<?php

namespace App\Http\Livewire\Components\Home;

use App\Models\Post;
use Livewire\Component;

class Solved extends Component
{
    public $posts;
    public function mount()
    {
        $this->posts = Post::with(['topic', 'replies', 'user'])
            ->where('is_solved', true)
            ->get()
            ->sortByDesc('created_at');
    }
    public function render()
    {
        return view('livewire.components.home.solved');
    }
}
