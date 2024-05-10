<?php

namespace App\Http\Livewire\Components\Post;

use Livewire\Component;

class PostCard extends Component
{
    public $post;
    public function mount($post)
    {
        $this->post = $post;
    }
    public function render()
    {
        return view('livewire.components.post.post-card');
    }
}
