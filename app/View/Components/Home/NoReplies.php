<?php

namespace App\View\Components\Home;

use App\Models\Post;
use Illuminate\View\Component;

class NoReplies extends Component
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
            ->where('replies_count', 0)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.no-replies');
    }
}
