<div class="relative w-full max-w-7xl mx-auto flex flex-col flex-grow items-center px-6 sm:px-16 text-white">
    @livewire('components.profile.profile-header', ['user' => $user])
    <div class="w-full flex flex-col items-center mt-20">
        <div class="mb-20">
            <p class="font-medium text-3xl">Activity</p>
        </div>
        @if ($user->posts_count == 0)
            <p class="text-5xl font-medium text-grey-600 mb-10">No Activity Yet</p>
            <i class="fa-solid fa-book fa-10x"></i>
        @else
            <div class="w-full mx-auto sm:flex-1 md:max-w-3xl ">
                @foreach ($posts as $post)
                    @livewire('components.post.post-card', ['post' => $post])
                @endforeach
            </div>
        @endif
    </div>
</div>
