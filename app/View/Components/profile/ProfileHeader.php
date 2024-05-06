<?php

namespace App\View\Components\profile;

use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ProfileHeader extends Component
{
    public $user;
    public $achievements;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();
        $this->achievements = Achievement::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.profile.profile-header');
    }
}
