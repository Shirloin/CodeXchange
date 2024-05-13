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
        $like = new Like();
        $like->user_id = Auth::user()->id;
        $like->post_id = $this->post->id;
        $like->save();
    }
    public function render()
    {
        return view('livewire.components.post.post-reply-card');
    }
}
