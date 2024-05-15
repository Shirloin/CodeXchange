<?php

namespace App\Http\Livewire\Components\Reply;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Livewire\Component;

class ReplyCard extends Component
{
    public $listeners = [
        'refreshReply' => 'refresh'
    ];
    public $reply;
    public  $replies = [];
    public function mount($reply)
    {
        $this->reply = $reply;
        $this->loadReplies();
    }
    public function refresh(){
        $this->reply = Reply::with('replies')->find($this->reply->id);
        $this->loadReplies();
    }
    protected  function loadReplies(){
        $this->replies = $this->reply->replies;
    }
    public function delete()
    {
        try {
            $this->reply->delete();
            $this->emitUp('refresh');
            Controller::SuccessMessage('Reply Successfully Deleted');
        } catch (\Exception $e) {
            Controller::FailMessage($e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.components.reply.reply-card');
    }
}
