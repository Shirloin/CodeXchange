<?php

namespace App\Http\Livewire\Components\Home;

use App\Models\Post;
use Livewire\Component;

class NoReplies extends Component
{
    public $posts;
    public function mount()
    {
        $this->posts = Post::with(['topic', 'replies', 'user'])
            ->where('replies_count', 0)
            ->orderBy('created_at', 'desc') 
            ->limit(50)
            ->get();
    }
    public function render()
    {
        return view('livewire.components.home.no-replies');
    }
}
