<?php

namespace App\Http\Livewire\Components\Reply;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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


    protected $rules = [
        'content' => 'required|min:5'
    ];
    protected $messages = [
        'required' => 'Content must be filled',
        'min' => 'Content length must be at least 5',
    ];

    public function mount($post = null, $msg = 'Reply to', $to = '',  $reply = null, $state = '')
    {
        $this->post = $post;
        $this->msg = $msg;
        $this->to = $to;
        $this->reply = $reply;
        $this->state = $state;
        if ($state === 'Update') {
            $this->content = $reply->content;
        }
    }
    public function save()
    {
        if (Auth::check()) {

            /** @var User $user */
            $user = Auth::user();
            if (!$user instanceof User) {
                Controller::FailMessage('Failed To Reply');
                return;
            }

            $validator = Validator::make(
                ['content' => $this->content],
                $this->rules,
                $this->messages
            );
            if ($validator->fails()) {
                Controller::FailMessage($validator->errors()->first());
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($this->state === 'Create') {
                $this->create($user);
            } else if ($this->state === 'Reply') {
                $this->reply($user);
            } else if ($this->state === 'Update') {
                $this->reply->content = $this->content;
                $this->reply->save();
                $this->emitUp('refreshReply');
            }
            Controller::SuccessMessage('Reply Saved');
        } else {
            Controller::FailMessage('User not logged in');
        }
    }
    public function create($user)
    {
        $reply = new Reply();
        $reply->id = getID();
        $reply->content = $this->content;
        $reply->user_id = $user->id;
        $reply->replyable()->associate($this->post);
        $reply->save();
        $this->content = '';
        $this->emitUp('refresh');
        $this->emitTo('components.post.post-detail-card', 'refreshPost');
    }
    public function reply($user)
    {
        $reply = new Reply();
        $reply->id = getID();
        $reply->content = $this->content;
        $reply->user_id = $user->id;
        $reply->replyable()->associate($this->reply);
        $reply->save();
        $this->content = '';
        $this->emitUp('refreshReply');
        $this->emitTo('components.post.post-detail-card', 'refreshPost');
    }

    public function render()
    {
        return view('livewire.components.reply.reply-pop-up');
    }
}
