<div>
    @foreach ($posts as $post)
        @livewire('components.post.post-card', ['post' => $post])
    @endforeach
</div>
