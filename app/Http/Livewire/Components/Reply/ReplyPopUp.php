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
    public $state;
    public function mount($post=null, $msg='Reply to', $to='',  $reply=null, $state=''){
        $this->post = $post;
        $this->msg = $msg;
        $this->to = $to;
        $this->reply = $reply;
        $this->state = $state;
        if($state === 'Update'){
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
            if($this->state === 'Create'){
                $reply = new Reply();
                $reply->id = getID();
                $reply->content = $this->content;
                $reply->user_id = $user->id;
                $reply->replyable()->associate($this->post);
                $reply->save();
            }
            else if($this->state === 'Reply'){
                $reply = new Reply();
                $reply->id = getID();
                $reply->content = $this->content;
                $reply->user_id = $user->id;
                $reply->replyable()->associate($this->reply);
                $reply->save();
            }
            else if($this->state === 'Update'){
                $this->reply->content = $this->content;
                $this->reply->save();
            }
            $this->mount();
            Controller::SuccessMessage('Reply Saved');
        }else{
            Controller::FailMessage('User not logged in');
        }
        $this->emit('refreshPost');
    }
    public function render()
    {
        return view('livewire.components.reply.reply-pop-up');
    }
}