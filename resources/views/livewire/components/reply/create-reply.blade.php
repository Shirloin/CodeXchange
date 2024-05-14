<div x-data="{ show: false }" x-cloak>
    <button class="w-full flex items-center p-6" x-on:click.prevent="show=!show" x-cloak>
        <div class="mr-5">
            <img class="w-12 h-12 rounded-xl" src={{ Auth::user()->image }} alt="">
        </div>
        Write a reply.
    </button>

    @livewire('components.reply.reply-pop-up', ['post' => $post, 'to' => 'Post'])
</div>
