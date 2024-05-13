<div class="relative w-full mx-auto flex flex-col flex-grow justify-start lg:gap-x-10 px-6 xl:px-16 py-10">
    <div class="w-full mx-auto sm:flex-1 md:max-w-3xl ">
        @livewire('components.post.post-reply-card', ['post' => $post])
        @foreach ($post->replies as $reply)
            @livewire('components.reply.reply-card', ['reply' => $reply])
        @endforeach
        <div class="mt-6 rounded-xl px-8  bg-blue-1600 text-white border border-panel-600 hover:border-dashed hover:border-blue-1200">
            @livewire('components.reply.create-reply')
        </div>
    </div>
</div>
