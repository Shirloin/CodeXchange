<div class="relative w-full mx-auto flex flex-grow justify-start lg:gap-x-10 px-6 xl:px-16  pt-10 text-white"
    x-data="{ tab: '#tab1' }">
    <aside class="w-52 hidden flex-none lg:sticky lg:top-10 lg:block lg:self-start" x-data="{ show: false }" x-cloak>
        @auth
            <button x-on:click.prevent="show=!show" wire:click='create'
                class="btn-blue-hover rounded-2xl flex justify-center items-center mb-8 w-full  py-4">
                <span class="inline-block flex-shrink-0 text-wrap">New Discussion</span>
            </button>
        @endauth
        @guest
            <button wire:click='create' class="btn-blue-hover rounded-2xl flex justify-center items-center mb-8 w-full  py-4">
                <span class="inline-block flex-shrink-0 text-wrap">New Discussion</span>
            </button>
        @endguest
        <div x-show='show'>
            @livewire('components.post.post-pop-up', ['state' => 'Create'])
        </div>
        <ul class="flex flex-col gap-y-2 lg:max-h-[80vh] lg:overflow-y-auto text-white font-semibold">
            <li class="side-nav-li" :class="{ 'text-blue-700': tab === '#tab1' }" x-on:click.prevent="tab='#tab1'">
                All Threads
            </li>
            <li class="side-nav-li" :class="{ 'text-blue-700': tab === '#tab2' }" x-on:click.prevent="tab='#tab2'">
                Solved</li>
            <li class="side-nav-li" :class="{ 'text-blue-700': tab === '#tab3' }" x-on:click.prevent="tab='#tab3'">
                Unsolved</li>
            <li class="side-nav-li" :class="{ 'text-blue-700': tab === '#tab4' }" x-on:click.prevent="tab='#tab4'">
                No Replies Yet
            </li>
        </ul>
    </aside>
    <div class="w-full mx-auto md:flex-1 xl:max-w-[835px] ">
        <div x-show="tab === '#tab1'">
            @livewire('components.home.all-thread')
        </div>
        <div x-show="tab === '#tab2'">
            @livewire('components.home.solved')
        </div>
        <div x-show="tab === '#tab3'">
            @livewire('components.home.unsolved')
        </div>
        <div x-show="tab === '#tab4'">
            @livewire('components.home.no-replies')
        </div>
    </div>
</div>
