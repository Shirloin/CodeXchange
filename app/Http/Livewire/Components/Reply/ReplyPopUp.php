<?php

namespace App\Http\Livewire\Components\Reply;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function App\Helper\getID;

class ReplyPopUp extends Component
{
    public $content;
    public $reply;
    public $post;
    public $msg;
    public $to;
    public function mount($post=null, $msg='Reply to', $to='',  $reply=null){
        $this->post = $post;
        $this->msg = $msg;
        $this->to = $to;
        if($reply!=null){
            $this->reply = $reply;
            $this->content = $reply->content;
        }
    }
    public function save(){
        if(Auth::check()){
            /** @var User $user */
            $user = Auth::user();
            if (!$user instanceof User) {
                Controller::FailMessage('Failed To Reply');
            }
            if($this->reply==null){
                $reply = new Reply();
                $reply->id = getID();
                $reply->content = $this->content;
                $reply->user_id = $user->id;
                $reply->post_id = $this->post->id;
                $reply->save();
            }else{
                $this->reply->content = $this->content;
                $this->reply->save();
            }
        }else{
            Controller::FailMessage('User not logged in');
        }
    }
    public function render()
    {
        return view('livewire.components.reply.reply-pop-up');
    }
}
