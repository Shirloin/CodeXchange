<?php

namespace App\Http\Livewire\Pages;

use App\Models\Post as ModelsPost;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public function mount($id = '')
    {
        $this->post = ModelsPost::find($id);
    }
    public function render()
    {
        return view('livewire.pages.post')->layout('layouts.template');
    }
}
