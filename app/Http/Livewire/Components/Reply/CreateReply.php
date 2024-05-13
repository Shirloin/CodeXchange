<?php

namespace App\Http\Livewire\Components\Reply;

use Livewire\Component;

class CreateReply extends Component
{
    public $content;
    public function render()
    {
        return view('livewire.components.reply.create-reply');
    }
}
