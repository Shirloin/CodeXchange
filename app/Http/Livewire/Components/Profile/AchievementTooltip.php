<?php

namespace App\Http\Livewire\Components\Profile;

use App\Models\Achievement;
use Livewire\Component;

class AchievementTooltip extends Component
{
    public $achievement;
    public $user;
    public $hasAchievement;
    public function mount($achievement, $user)
    {
        $this->achievement = $achievement;
        $this->user = $user;
        $this->hasAchievement = $user->achievements()->where('achievement_id', $achievement->id)->exists();
    }
    public function render()
    {
        return view('livewire.components.profile.achievement-tooltip');
    }
}
