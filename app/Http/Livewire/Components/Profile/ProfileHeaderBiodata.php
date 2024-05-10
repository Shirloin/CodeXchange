<?php

namespace App\Http\Livewire\Components\Profile;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProfileHeaderBiodata extends Component
{
    use AuthorizesRequests;
    public $user;
    public function mount($user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.components.profile.profile-header-biodata');
    }
}
