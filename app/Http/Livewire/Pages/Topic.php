<?php

namespace App\Http\Livewire\Pages;

use App\Models\Topic as ModelsTopic;
use Livewire\Component;

class Topic extends Component
{
    public $topics;

    public function render()
    {
        $this->topics = ModelsTopic::all();
        return view('livewire.pages.topic')->layout('layouts.template');
    }
}
