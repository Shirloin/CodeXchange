<?php

namespace App\Http\Livewire\Components\Post;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostCard extends Component
{
    public $post;
    public function mount($post)
    {
        $this->post = $post;
    }
    public function addToLibrary()
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            if (!$user instanceof User) {
                Controller::FailMessage('Unauthenticated User');
                return;
            }
            if ($user->hasPost($this->post)) {
                $user->libraries()->detach($this->post->id);
                Controller::SuccessMessage("Post Removed From Library");
            } else {
                $user->libraries()->attach($this->post->id);
                Controller::SuccessMessage("Post Added To Library");
            }
            $this->emit('refresh');
        } else {
            Controller::FailMessage("User are not logged in");
        }
    }
    public function render()
    {
        return view('livewire.components.post.post-card');
    }
}
