<div class="relative w-full mx-auto flex flex-col flex-grow justify-start lg:gap-x-10 px-6 xl:px-16 py-10">
    @if ($posts->count() > 0)
        <div class="w-full mx-auto sm:flex-1 md:max-w-3xl">
            @foreach ($posts as $post)
                @livewire('components.post.post-card', ['post' => $post])
            @endforeach
        </div>
    @else
        <div class="m-auto flex flex-col items-center">
            <p class="text-3xl  font-medium text-grey-600 mb-10">No Post Saved</p>
            <i class="fa-solid fa-book fa-8x sm:fa-10x text-white"></i>
        </div>
    @endif
</div>
