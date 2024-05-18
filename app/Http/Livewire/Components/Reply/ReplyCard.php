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
        $this->reply = Reply::with('replies')->find($this->reply->id);
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
            if($post->replies->count() == 0){
                $this->post->update(['is_solved' => false]);
            }
            foreach ($post->replies as $reply) {
                if (!$reply->hasApprovedReplies()) {
                    $this->post->update(['is_solved' => false]);
                } else {
                    $this->post->update(['is_solved' => true]);
                }
            }
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
        $this->reply->is_approved = true;
        $this->reply->save();
        $this->post->is_solved = true;
        $this->post->save();
        $this->emitUp('refresh');
        $this->emitTo('components.post.post-detail-card', 'refreshPost');
        Controller::SuccessMessage("Reply is approved");
    }
    public function render()
    {
        return view('livewire.components.reply.reply-card');
    }
}
