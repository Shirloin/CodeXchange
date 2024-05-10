<?php

namespace App\Http\Livewire\Pages;

use App\Models\Post;
use App\Models\Topic as ModelsTopic;
use Livewire\Component;

class Topic extends Component
{
    public $topics;
    public $posts;
    public $name;

    public function mount($name = '')
    {
        $this->topics = ModelsTopic::all();
        if ($name != null) {
            $this->name = $name;
            $this->posts = Post::whereHas('topics', function ($query) use ($name) {
                $query->where('name', $name);
            })->get();
        }
    }

    public function render()
    {
        return view('livewire.pages.topic')->layout('layouts.template');
    }
}
