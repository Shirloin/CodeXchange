<?php

namespace App\Http\Livewire\Components\Profile;

use Livewire\Component;

class AchievementTooltip extends Component
{
    public $achievement;
    public function mount($achievement)
    {
        $this->achievement = $achievement;
    }
    public function render()
    {
        return view('livewire.components.profile.achievement-tooltip');
    }
}
