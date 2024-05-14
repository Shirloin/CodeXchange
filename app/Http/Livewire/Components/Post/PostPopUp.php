<?php

namespace App\Http\Livewire\Components\Post;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Livewire\Component;

class PostPopUp extends Component
{
    public $topics;
    public $post;
    public $title;
    public $content;
    public $topic;
    public function mount($post){
        $this->topics = Topic::all();
        if($post){
            $this->post = $post;
            $this->title = $post->title;
            $this->content = $post->content;
            $this->topic = $post->topic_id;
        }
    }
    public function save(){
        $this->post->title = $this->title;
        $this->post->content = $this->content;
        $this->post->topic_id = $this->topic;
        $this->post->save();
        Controller::SuccessMessage('Post Updated');
        $this->emit('refreshPost');
    }
    public function render()
    {
        return view('livewire.components.post.post-pop-up');
    }
}
