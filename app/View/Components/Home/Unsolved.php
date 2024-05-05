<?php

namespace App\View\Components\Home;

use App\Models\Post;
use Illuminate\View\Component;

class Unsolved extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $posts;
    public function __construct()
    {
        $this->posts = Post::with(['topics', 'replies', 'user'])
            ->where('is_solved', false)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.unsolved');
    }
}
