<div class="mb-4 mt-6 flex flex-row items-center justify-center  space-x-4 lg:ml-auto lg:mt-0 lg:justify-end">
    <div
        class="group h-32 w-20  sm:h-56 sm:w-36 flex-shrink-0 cursor-pointer rounded-xl border border-transparent bg-blue-1000 p-2  text-center text-white transition-all hover:border-blue-1100 hover:text-blue-1200">
        <div class="mb-2 flex items-center justify-center h-8 sm:h-24">
            <i class="fa-solid fa-image-portrait fa-2x sm:fa-4x text-white"></i>
        </div>
        <strong class="mb-2 block text-sm sm:text-2xl font-bold">{{ $user->posts_count }}</strong>
        <div class="text-xs sm:text-sm leading-tight">Total <br>Posts</div>
    </div>
    <div
        class="group h-32 w-20  sm:h-56 sm:w-36 flex-shrink-0 cursor-pointer rounded-xl border border-transparent bg-blue-1000 p-2 text-center text-white transition-all hover:border-blue-1100 hover:text-blue-1200">
        <div class="mb-2 flex items-center justify-center h-8 sm:h-24">
            <i class="fa-solid fa-comment fa-2x sm:fa-4x text-white"></i>
        </div>
        <strong class="mb-2 block text-sm sm:text-2xl font-bold">{{ $user->replies_count }}</strong>
        <div class="text-xs sm:text-sm leading-tight">Total <br>Replies</div>
    </div>
    <div
        class="group h-32 w-20  sm:h-56 sm:w-36 flex-shrink-0 cursor-pointer rounded-xl border border-transparent bg-blue-1000 p-2 text-center text-white transition-all hover:border-blue-1100 hover:text-blue-1200">
        <div class="mb-2 flex items-center justify-center h-8 sm:h-24">
            <i class="fa-solid fa-heart fa-2x sm:fa-4x text-white"></i>
        </div>
        <strong class="mb-2 block text-sm sm:text-2xl font-bold">{{ $user->likes_count }}</strong>
        <div class="text-xs sm:text-sm leading-tight">Total <br>Likes</div>
    </div>
</div>
