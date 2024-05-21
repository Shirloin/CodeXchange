<a href="/post/{{ $post->id }}"
    class="bg-container text-white border-2 border-panel-600 w-full min-h-40 flex md:flex-row flex-col  p-4 rounded-xl mb-5">
    <div class="flex justify-between items-start md:mr-5 mb-5 md:mb-0 ">
        <object class="" data="" type="">
            <a href="/profile/{{ $post->user->id }}" class="flex text-xl font-medium ">
                <img class="w-14 h-14 object-cover rounded-md mr-5" src={{ $post->user->image }} alt="">
                <p class="group relative flex md:hidden h-fit">{{ $post->user->username }} <span
                        class="underline-animation"></span>
                </p>
            </a>
        </object>
        <div class="h-fit flex items-center gap-1 md:hidden">
            <i class="fa-solid fa-comment"></i>
            <p>{{ $post->replies_count }}</p>
        </div>
    </div>
    <div class="w-full h-fit flex flex-col">
        <div class="flex justify-between mb-5">
            <object data="" type="">
                <a href="/post/{{ $post->id }}"
                    class=" text-xl font-medium max-w-xl text-wrap text-ellipsis line-clamp-1 truncate hover:cursor-pointer hover:underline">
                    {{ $post->title }}
                </a>
            </object>
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
        <div class="w-full mb-5">
            <p class="font-medium text-sm text-ellipsis text-wrap line-clamp-2 truncate">{{ $post->content }}</p>
        </div>
        <div class="flex flex-wrap items-start text-sm">
            <div class=" flex items-center mr-3 text-ellipsis text-wrap">
                @php
                    $reply = $post->replies()->latest()->first();
                @endphp
                <object data="" type="">
                    <a href="/profile/{{ $reply ? $reply->user_id : $post->user_id }}"
                        class="text-blue-500 mr-1 hover:underline hover:text-blue-700 transition-colors duration-300">
                        {{ $reply ? $reply->user->username : $post->user->username }}
                    </a>
                </object>
                @if ($reply != null)
                    <span>replied {{ getTime($reply->created_at) }}</span>
                @else
                    <span>posted {{ getTime($post->created_at) }}</span>
                @endif
            </div>
            @if ($post->is_solved)
                <div class="bg-gray-600 flex items-center text-xs font-bold rounded-full px-2 py-1">
                    <i class="fa-solid fa-check mr-3"></i>
                    <p>Solved</p>
                </div>
            @endif
            @can(['add-to-library'], $post)
                <button class="relative ml-auto text-xl self-center" wire:click.prevent='addToLibrary'>
                    @if (Auth::user()->hasPost($post))
                        <i class="fa-solid fa-bookmark"></i>
                    @else
                        <i class="fa-regular fa-bookmark"></i>
                    @endif
                </button>
            @endcan
        </div>
    </div>
</a>
