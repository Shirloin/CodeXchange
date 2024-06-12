<?php

namespace App\Http\Livewire\Components\Reply;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Reply;
use Livewire\Component;

class ReplyCard extends Component
{
    public $listeners = [
        'refreshReply' => 'refresh'
    ];
    public $post;
    public $reply;
    public  $replies = [];
    public function mount($reply, $post)
    {
        $this->post = $post;
        $this->reply = $reply;
        $this->loadReplies();
    }
    public function refresh()
    {
        $this->reply = Reply::with(['replies' => function($query){
            $query->orderBy('created_at', 'desc');
        }])->find($this->reply->id);
        $this->loadReplies();
    }
    protected  function loadReplies()
    {
        $this->replies = $this->reply->replies;
    }
    public function delete()
    {
        try {
            $this->reply->delete();
            $post = Post::find($this->post->id);
            $post->checkSolved();
            $this->emitUp('refresh');
            $this->emitTo('components.post.post-detail-card', 'refreshPost');
            $this->emitUp('refreshReply');
            Controller::SuccessMessage('Reply Successfully Deleted');
        } catch (\Exception $e) {
            Controller::FailMessage($e->getMessage());
        }
    }
    public function setApprove()
    {
        $this->reply->update(['is_approved' => true]);
        if (!$this->post->is_solved) {
            $this->post->update(['is_solved' => true]);
        }
        $this->emitUp('refresh');
        $this->emitTo('components.post.post-detail-card', 'refreshPost');
        Controller::SuccessMessage("Reply is approved");
    }
    public function edit()
    {
        if ($this->reply->is_approved) {
            Controller::FailMessage("Reply has been approved! You are not allowed to change it.");
            return;
        }
    }
    public function render()
    {
        return view('livewire.components.reply.reply-card');
    }
}
