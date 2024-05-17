<?php

namespace App\Http\Livewire\Components\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

use function App\Helper\getID;

class PostPopUp extends Component
{
    public $topics;
    public $post;
    public $title;
    public $content;
    public $topic;
    public $state;

    public function mount($post = null, $state = '')
    {
        $this->topics = Topic::all();
        $this->state = $state;
        if ($state == 'Update') {
            $this->post = $post;
            $this->title = $post->title;
            $this->content = $post->content;
            $this->topic = $post->topic_id;
        }
    }
    public function save()
    {
        if (Auth::check()) {
            $data = [
                'title' => $this->title,
                'content' => $this->content,
                'topic' => $this->topic,
            ];
            $rules = [
                'title' => ['required', 'min:5', 'max:25'],
                'content' => ['required', 'min: 5'],
                'topic' => ['required']
            ];
            $messages = [
                'title.required' => 'Title must be filled',
                'title.min' => 'Title length must be at least 5 characters',
                'title.max' => 'Title length must be less than 25 characters',
                'content.required' => 'Content must be filled',
                'content.min' => 'Content length must be at least 5 characters',
                'topic.required' => 'Topic has not been choosen',
            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                Controller::FailMessage($validator->errors()->first());
                return redirect()->back()->withErrors($validator)->withInput();
            }
            /** @var User $user */
            $user = auth()->user();
            if (!$user instanceof User) {
                Controller::FailMessage('Create Post Failed');
            }
            if ($this->state === 'Create') {
                $post = new Post();
                $post->id = getID();
                $post->title = $this->title;
                $post->content = $this->content;
                $post->topic_id = $this->topic;
                $post->user()->associate(Auth::user());
                $post->save();
                $this->title = '';
                $this->content = '';
                $this->topic = '';
                Controller::SuccessMessage('Post Successfully Created');
                return redirect('/post/' . $post->id);
            } else {
                $this->post->title = $this->title;
                $this->post->content = $this->content;
                $this->post->topic_id = $this->topic;
                $this->post->save();
                Controller::SuccessMessage('Post Updated');
                $this->emitUp('refreshPost');
            }
        } else {
            Controller::FailMessage("User has not logged in");
        }
    }
    public function render()
    {
        return view('livewire.components.post.post-pop-up');
    }
}
