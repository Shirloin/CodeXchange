<?php

namespace App\Http\Livewire\Components\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function App\Helper\getID;

class PostPopUp extends Component
{
    public $topics;
    public $post;
    public $title;
    public $content;
    public $topic;
    public $state;
    public function mount($post = null, $state = '')
    {
        $this->topics = Topic::all();
        $this->state = $state;
        if ($state == 'Update') {
            $this->post = $post;
            $this->title = $post->title;
            $this->content = $post->content;
            $this->topic = $post->topic_id;
        }
    }
    public function save()
    {
        if (Auth::check()) {
            if ($this->state === 'Create') {
                $post = new Post();
                $post->id = getID();
                $post->title = $this->title;
                $post->content = $this->content;
                $post->topic_id = $this->topic;
                $post->user()->associate(Auth::user());
                $post->save();
                $this->title = '';
                $this->content = '';
                $this->topic = '';
                Controller::SuccessMessage('Post Successfully Created');
            } else {
                $this->post->title = $this->title;
                $this->post->content = $this->content;
                $this->post->topic_id = $this->topic;
                $this->post->save();
                Controller::SuccessMessage('Post Updated');
                $this->emitUp('refreshPost');
            }
        }
    }
    public function render()
    {
        return view('livewire.components.post.post-pop-up');
    }
}
