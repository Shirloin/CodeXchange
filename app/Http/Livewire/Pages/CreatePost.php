<?php

namespace App\Http\Livewire\Pages;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

use function App\Helper\getID;

class CreatePost extends Component
{
    public $topics;
    public $title;
    public $content;
    public $topic = '';
    public function mount()
    {
        $this->topics = Topic::all();
    }
    public function save()
    {
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
        $post = new Post();
        $post->id = getID();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->topic_id = $this->topic;
        $post->user_id = $user->id;
        $post->save();
        Controller::SuccessMessage('Create Post Success');
        return redirect('/');
    }
    public function render()
    {
        return view('livewire.pages.create-post')->layout('layouts.template');
    }
}
