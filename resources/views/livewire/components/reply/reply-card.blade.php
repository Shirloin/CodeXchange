<div>
    <div class="relative ml-16 before-content">
        <div
            class="group/reply mb-3 rounded-xl p-0  text-white border-panel-600 bg-blue-1600 border hover:border-blue-1200">
            <div class="flex px-6 py-4 lg:p-5">
                {{-- Image --}}
                <div class="mr-5 hidden max-w-min text-left md:block">
                    <a class="relative flex items-start mb-2 rounded-lg w-20 h-20 p-0.5"
                        href="/profile/{{ $reply->user_id }}">
                        <img class="relative w-20 h-20 rounded-lg" src={{ $reply->user->image }} loading='lazy'
                            alt="">
                    </a>
                    <div class="text-center leading-none text-grey-500">
                        <p class="text-sm font-semibold">Level {{ $reply->user->level }}</p>
                    </div>
                </div>
                <div class="relative flex flex-1 flex-col">
                    {{-- Header --}}
                    <div class="mb-4 flex items-center justify-between">
                        <div class="md:hidden">
                            <a class="relative mr-4 block overflow-hidden rounded-lg"
                                href="/profile/{{ $reply->user_id }}">
                                <img class="min-w-10 min-h-10 w-10 h-10 object-cover bg-white md:w-20 md:h-20 rounded-lg"
                                    src={{ $reply->user->image }} alt="">
                            </a>
                        </div>
                        <div class="flex-1 text-left leading-none">
                            <div class="flex items-center">
                                <a class="h-fit mr-2 block text-lg font-bold text-white"
                                    href="/profile/{{ $reply->user_id }}">{{ $reply->user->username }}</a>
                            </div>
                            <div class="mt-2 flex flex-wrap items-center gap-x-1 text-xs font-medium">
                                <p class="text-2xs text-grey-600">Replied 53 minutes ago</p>
                            </div>
                        </div>
                        <div class="relative ml-3 flex -top-1">
                            <div class="hidden md:flex gap-6 font-medium">
                                @if ($reply->is_approved)
                                    <div class="bg-gray-600 flex items-center text-xs font-bold rounded-full px-4 py-2">
                                        <i class="fa-solid fa-check mr-2"></i>
                                        <p>Approved</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Content --}}
                    <div class="mb-0 text-grey-100 leading-relaxed break-words">
                        {{ $reply->content }}
                    </div>
                    {{-- Action --}}
                    <div class="mt-auto">
                        <div class="relative h-9 -mb-1 mt-4 flex justify-start" x-data="{ show: false }">
                            @auth
                                <button x-on:click="show=true"
                                    class="hidden group-hover/reply:inline-flex justify-center items-center post-action-btn">
                                    <p>Reply</p>
                                </button>
                                <div x-show="show">
                                    @livewire('components.reply.reply-pop-up', ['reply' => $reply, 'msg' => 'Reply to', 'to' => $reply->user->username, 'state' => 'Reply'])
                                </div>
                            @endauth
                            @can('isMyPost', $post)
                                @if ($reply->is_approved)
                                @else
                                    <button wire:click='setApprove'
                                        class="hidden group-hover/reply:inline-flex justify-center items-center post-action-btn">
                                        <p>Set Approve</p>
                                    </button>
                                @endif
                            @endcan
                            @can('isMyReply', $reply)
                                <div class="relative ml-auto" x-data="{ dropdown: false, show: false }" x-cloak>
                                    <div class="relative inline-block text-left" @click.away="dropdown=false">
                                        <button x-on:click="dropdown=!dropdown"
                                            class="inline-flex items-center text-xs px-6 py-2 rounded-xl bg-blue-1700 font-semibold text-grey-600 hover:bg-blue-1800">
                                            <p class="relative -top-1">...</p>
                                        </button>
                                        <div x-show="dropdown"
                                            x-transition:enter="transition ease-out duration-100 transform"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75 transform"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95"
                                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg  focus:outline-none">
                                            <div class="p-1.5 text-black font-medium text-sm">
                                                <button
                                                    class="w-full rounded-lg text-left block px-4 py-1.5 hover:bg-gray-200"
                                                    x-on:click.prevent="show = true; dropdown = false">Edit</button>
                                                <button wire:click='delete' x-on:click="dropdown=false"
                                                    class="w-full  rounded-lg text-left block px-4 py-1.5 hover:bg-gray-200">Delete</button>
                                            </div>
                                        </div>
                                        <div x-show="show">
                                            @livewire('components.reply.reply-pop-up', ['reply' => $reply, 'msg' => 'Update your reply', 'state' => 'Update'])
                                        </div>
                                    </div>

                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($replies as $reply)
        @livewire('components.reply.reply-card', ['reply' => $reply, 'post' => $post], key($reply->id))
    @endforeach
</div>
