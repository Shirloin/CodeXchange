<?php

namespace App\Http\Livewire\Pages;

use App\Models\Topic;
use Livewire\Component;

class CreatePost extends Component
{
    public $topics;
    public function mount()
    {
        $this->topics = Topic::all();
    }
    public function render()
    {
        return view('livewire.pages.create-post')->layout('layouts.template');
    }
}
