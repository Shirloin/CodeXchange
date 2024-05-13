<div class="mb-3 rounded-xl p-0 bg-blue-1600 text-white border border-panel-600">
    <div class="flex px-6 py-4 lg:p-5">
        {{-- Image --}}
        <div class="mr-5 hidden max-w-min text-left md:block">
            <a class="relative flex items-start mb-2 rounded-lg w-20 h-20 p-0.5" href="/profile/{{ $post->user_id }}">
                <img class="relative w-20 h-20 rounded-lg" src={{ $post->user->image }} loading='lazy' alt="">
            </a>
            <div class="text-center leading-none text-grey-500">
                <p class="text-sm font-semibold">Level {{ $post->user->level }}</p>
            </div>
        </div>
        <div class="relative flex flex-1 flex-col">
            {{-- Header --}}
            <div class="mb-4 flex items-center justify-between">
                <div class="md:hidden">
                    <a class="relative mr-4 block overflow-hidden rounded-lg" href="/profile/{{ $post->user_id }}">
                        <img class="w-10 h-10 object-cover bg-white md:w-20 md:h-20 rounded-lg"
                            src={{ $post->user->image }} alt="">
                    </a>
                </div>
                <div class="flex-1 text-left leading-none">
                    <div class="flex items-center">
                        <a class="h-fit mr-2 block text-lg font-bold text-white"
                            href="/profile/{{ $post->user_id }}">{{ $post->user->username }}</a>
                    </div>
                    <div class="mt-2 flex flex-wrap items-center gap-x-1 text-xs font-medium">
                        <p class="text-2xs text-grey-600">Posted 53 minutes ago</p>
                    </div>
                </div>
                <div class="relative ml-3 flex -top-1">
                    <div class="hidden md:flex gap-6 font-medium">
                        <div class="flex items-center gap-1">
                            <i class="fa-solid fa-comment"></i>
                            <p>{{ $post->replies_count }}</p>
                        </div>
                        @php
                            $topicComponents = [
                                'C' => 'c-topic',
                                'SQL' => 'sql-topic',
                                'MongoDB' => 'mongodb-topic',
                                'Java' => 'java-topic',
                                'HTML' => 'html-topic',
                                'CSS' => 'css-topic',
                                'Javascript' => 'js-topic',
                                'Laravel' => 'laravel-topic',
                                'Network' => 'network-topic',
                            ];
                            $topicName = $post->topic->name;
                            $componentName = $topicComponents[$topicName] ?? null;
                        @endphp
                        @if ($componentName)
                            @include('components.topic.' . $componentName)
                        @endif
                    </div>
                </div>
            </div>
            {{-- Title --}}
            <h1 class="mb-4 rounded-xl bg-blue-1500 px-6 py-4 text-lg font-semibold text-white break-words">
                {{ $post->title }}
            </h1>
            {{-- Content --}}
            <div class="mb-0 text-grey-100 leading-relaxed break-words">
                {{ $post->content }}
            </div>
            {{-- Action --}}
            @can('isMyPost', $post)
                <div class="mt-auto">
                    <div class="relative h-9 -mb-1 mt-4 flex justify-start ">
                            <button class="bg-blue-1700 inline-flex justify-center items-center font-semibold  text-sm py-2 w-16 px-0 border-transparent mr-auto md:mr-0 rounded-xl {{Auth::user()->hasLikedPost($post) ? "bg-blue-1200" : "text-grey-600"}}">
                                <i class="fa-solid fa-heart mr-2"></i>
                                <p class="font-semibold ">{{$post->likes_count}}</p>
                            </button>
                        <div class="relative ml-auto">
                            <div class=" relative inline-block text-left" x-data="{ show: false }" x-cloak>
                                <button x-on:click="show=!show" @click.away="show = false"
                                    class="inline-flex items-center text-xs px-6 py-2 rounded-xl bg-blue-1700 font-semibold text-grey-600 hover:bg-blue-1800">
                                    <p class="relative -top-1">...</p>
                                </button>
                                <div x-show="show" x-transition:enter="transition ease-out duration-100 transform"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75 transform"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg  focus:outline-none">
                                    <div class="p-1.5 text-black font-medium text-sm">
                                        <button
                                            class="w-full  rounded-lg text-left block px-4 py-1.5  hover:bg-gray-200">Edit</button>
                                        <button
                                            class="w-full  rounded-lg text-left block px-4 py-1.5 hover:bg-gray-200">Delete</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</div>
