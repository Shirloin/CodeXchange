<?php

namespace App\Http\Livewire\Components\Profile;

use Livewire\Component;

class ProfileHeaderActivity extends Component
{
    public $user;
    public function mount($user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.components.profile.profile-header-activity');
    }
}
