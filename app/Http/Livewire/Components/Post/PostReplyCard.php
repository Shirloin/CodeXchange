<?php

namespace App\Http\Livewire\Components\Post;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostReplyCard extends Component
{
    public $post;
    public function mount($post)
    {
        $this->post = $post;
    }
    public function like()
    {
        if (Auth::user()->hasLikedPost($this->post)) {
            Auth::user()->unlike($this->post);
        } else {
            Auth::user()->like($this->post);
        }
    }
    public function render()
    {
        return view('livewire.components.post.post-reply-card');
    }
}
