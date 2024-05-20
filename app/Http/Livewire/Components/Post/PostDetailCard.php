<?php

namespace App\Http\Livewire\Components\Post;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostDetailCard extends Component
{
    protected $listeners = [
        'refreshPost' => 'refresh',
    ];
    public $post;
    public function mount($post)
    {
        $this->post = $post;
    }
    public function refresh()
    {
        $this->post = Post::with('likes')->find($this->post->id);
    }
    public function like()
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            if (!$user instanceof User) {
                Controller::FailMessage('User are not logged in');
            }
            if ($user->hasLikedPost($this->post)) {
                $user->unlike($this->post);
            } else {
                $user->like($this->post);
            }
            $this->post = Post::find($this->post->id);
        } else {
            Controller::FailMessage("User are not logged in");
        }
    }
    public function delete()
    {
        $this->post->delete();
        Controller::SuccessMessage('Post Successfully Deleted');
        return redirect('/');
    }
    public function addToLibrary(){
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            if (!$user instanceof User) {
                Controller::FailMessage('User are not logged in');
            }
            if($user->libraries->contains($this->post)){
                $user->libraries()->detach($this->post->id);
                Controller::SuccessMessage("Post Removed From Library");
            }
            else{
                $user->libraries()->attach($this->post->id);
                Controller::SuccessMessage("Post Added To Library");
            }
        } else {
            Controller::FailMessage("User are not logged in");
        }
    }
    public function render()
    {
        return view('livewire.components.post.post-detail-card');
    }
}
