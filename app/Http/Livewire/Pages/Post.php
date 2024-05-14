<?php

namespace App\Http\Livewire\Pages;

use App\Models\Post as ModelsPost;
use Livewire\Component;

class Post extends Component
{
    protected $listeners = ['refreshPost' => 'refresh'];
    public $post;
    public function mount($id = '')
    {
        $this->post = ModelsPost::find($id);
    }
    public function refresh()
    {
        $this->post = ModelsPost::find($this->post->id);
    }

    public function render()
    {
        return view('livewire.pages.post')->layout('layouts.template');
    }
}
