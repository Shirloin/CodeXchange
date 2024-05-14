<?php

namespace App\Http\Livewire\Components\Reply;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Livewire\Component;

class ReplyCard extends Component
{
    public $reply;
    public function mount($reply)
    {
        $this->reply = $reply;
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
