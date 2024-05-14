<?php

namespace App\Http\Livewire\Components\Reply;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function App\Helper\getID;

class CreateReply extends Component
{
    public $content;
    public $post;
    public function mount($post){
        $this->post = $post;
    }
    public function render()
    {
        return view('livewire.components.reply.create-reply');
    }
}
