<?php

namespace App\View\Components\achievement;

use App\Models\Achievement;
use Illuminate\View\Component;

class AchievementTooltip extends Component
{
    public $achievement;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($achievement)
    {
        $this->achievement = $achievement;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.achievement.achievement-tooltip');
    }
}
