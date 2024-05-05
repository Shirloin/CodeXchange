<div>
    @foreach ($posts as $post)
        <x-post.post-card :post="$post" />
    @endforeach
</div>
