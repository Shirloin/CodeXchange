<?php

namespace App\Http\Livewire\Pages;

use App\Models\Post as ModelsPost;
use Livewire\Component;

class Post extends Component
{
    protected $listeners = [
        'refresh' => 'refresh',
    ];
    public $post;
    public function mount($id = '')
    {
        $this->post = ModelsPost::with('likes')->find($id);
    }
    public function refresh()
    {
        $this->post = ModelsPost::with('likes')->find($this->post->id);
    }
    public function render()
    {
        return view('livewire.pages.post')->layout('components.layouts.template');
    }
}
