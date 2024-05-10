<?php

namespace App\Http\Livewire\Components\Profile;

use App\Models\Achievement;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class ProfileHeader extends Component
{
    public $user;
    public $achievements;

    public function mount($user)
    {
        $this->user = $user;
        $this->achievements = Achievement::all();
    }

    public function render()
    {
        return view('livewire.components.profile.profile-header');
    }
}
