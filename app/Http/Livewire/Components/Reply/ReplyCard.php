<?php

namespace App\Http\Livewire\Components\Reply;

use Livewire\Component;

class ReplyCard extends Component
{
    public $reply;
    public function mount($reply){
        $this->reply = $reply;
    }
    public function delete(){
        $this->reply->delete();
        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.components.reply.reply-card');
    }
}
