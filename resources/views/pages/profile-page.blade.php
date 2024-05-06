@extends('templates.template')

@section('content')
    <div class="relative w-full max-w-7xl mx-auto flex flex-col flex-grow items-center px-6 sm:px-16 text-white">
        <div class="container mt-12">
            <div class="mx-auto lg:mx-0 lg:flex lg:max-w-full lg:items-center">
                <div class="flex justify-center">
                    <img class="w-16 h-16 sm:w-28 sm:h-28  rounded-3xl mr-8" src={{ $user->image }} alt="">
                    <p class="text-3xl">{{ $user->username }}</p>
                </div>
                <div class="lg:ml-auto ">
                    <div
                        class="mb-4 mt-6 flex flex-row items-center justify-center sm:justify-between space-x-4 lg:ml-auto lg:mt-0 lg:justify-end">
                        <div
                            class="group h-32 w-20  sm:h-56 sm:w-36 flex-shrink-0 cursor-pointer rounded-xl border border-transparent bg-blue-1000 p-2  text-center text-white transition-all hover:border-blue-1100 hover:text-blue-1200">
                            <div class="mb-2 flex items-center justify-center h-8 sm:h-24">
                                <i class="fa-solid fa-image-portrait fa-2x sm:fa-4x"></i>
                            </div>
                            <strong class="mb-2 block text-sm sm:text-2xl font-bold">{{$user->posts_count}}</strong>
                            <div class="text-xs sm:text-sm leading-tight">Total <br>Posts</div>
                        </div>
                        <div
                            class="group h-32 w-20  sm:h-56 sm:w-36 flex-shrink-0 cursor-pointer rounded-xl border border-transparent bg-blue-1000 p-2 text-center text-white transition-all hover:border-blue-1100 hover:text-blue-1200">
                            <div class="mb-2 flex items-center justify-center h-8 sm:h-24">
                                <i class="fa-solid fa-comment fa-2x sm:fa-4x"></i>
                            </div>
                            <strong class="mb-2 block text-sm sm:text-2xl font-bold">{{$user->replies_count}}</strong>
                            <div class="text-xs sm:text-sm leading-tight">Total <br>Replies</div>
                        </div>
                        <div
                            class="group h-32 w-20  sm:h-56 sm:w-36 flex-shrink-0 cursor-pointer rounded-xl border border-transparent bg-blue-1000 p-2 text-center text-white transition-all hover:border-blue-1100 hover:text-blue-1200">
                            <div class="mb-2 flex items-center justify-center h-8 sm:h-24">
                                <i class="fa-solid fa-heart fa-2x sm:fa-4x"></i>
                            </div>
                            <strong class="mb-2 block text-sm sm:text-2xl font-bold">{{$user->likes_count}}</strong>
                            <div class="text-xs sm:text-sm leading-tight">Total <br>Likes</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full flex flex-wrap justify-center">
                @foreach ($achievements as $achievement)
                    <div class="tooltip" data-tip={{ $achievement->description }}>
                        <img class="w-12 sm:w-24 opacity-40 hover:opacity-100" src={{ $achievement->image }} alt="">
                    </div>
                @endforeach
            </div>
            <div class="flex items-center text-xs font-bold uppercase mt-4">
                <span>Level 1</span>
                <progress class="progress progress-primary mx-4 flex-1 rounded-full bg-black h-2" value="32" max="100"></progress>
                <span>{{ $user->xp }} XP</span>
            </div>
        </div>
        <div class="flex flex-col items-center mt-20">
            <div class="mb-20">
                <p class="font-medium text-3xl">Activity</p>
            </div>
            @if($user->posts_count == 0)
                <p class="text-5xl font-medium text-grey-600 mb-10">No Activity Yet</p>
                <i class="fa-solid fa-book fa-10x"></i>
            @endif
        </div>
    </div>
@endsection
