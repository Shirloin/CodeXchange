<a href=""
    class="bg-container border-2 border-panel-600 w-full min-h-40 flex md:flex-row flex-col  p-4 rounded-xl mb-5">
    <div class="flex justify-between items-start md:mr-5 mb-5 md:mb-0 ">
        <object class="" data="" type="">
            <a href="" class="flex text-xl font-medium ">
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
            <div
                class="group relative text-xl font-medium max-w-xl text-wrap text-ellipsis line-clamp-1 truncate hover:cursor-pointer">
                {{ $post->title }}
                <span class="underline-animation"></span>
            </div>
            <div class="hidden md:flex gap-6">
                <div class="flex items-center gap-1">
                    <i class="fa-solid fa-comment"></i>
                    <p>{{ $post->replies_count }}</p>
                </div>
                <p
                    class="h-fit rounded-full ring-1 ring-orange-400 text-orange-400 text-center w-36 py-1 hover:bg-orange-400 hover:text-white transition-colors duration-300">
                    {{ $post->topics->first()->name }}
                </p>
            </div>
        </div>
        <div class="w-full mb-5">
            <p class="font-medium text-sm text-ellipsis text-wrap line-clamp-2 truncate">{{ $post->content }}</p>
        </div>
        <div class="flex flex-wrap items-start text-sm">
            <div class=" flex items-center mr-3 text-ellipsis text-wrap">
                <object data="" type="">
                    <a href=""
                        class="text-blue-500 mr-1 hover:underline hover:text-blue-700 transition-colors duration-300">
                        Shirloin
                    </a>
                </object>
                <span>replied 23 minutes ago</span>
            </div>
            @if ($post->is_solved)
                <div class="bg-gray-600 flex items-center text-xs font-bold rounded-full px-2 py-1">
                    <i class="fa-solid fa-check mr-3"></i>
                    <p>Solved</p>
                </div>
            @endif
        </div>
    </div>
</a>
