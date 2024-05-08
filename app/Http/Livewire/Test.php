<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{
    public $gender = 'Male';
    public function set($gender){
        $this->gender = $gender;
    }
    public function render()
    {
        return view('livewire.test');
    }
}
