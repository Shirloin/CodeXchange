<div class="container mt-12">
    <div class="mx-auto lg:mx-0 lg:flex lg:max-w-full lg:items-center">
        <div class="flex justify-center">
            <img class="w-16 h-16 sm:w-28 sm:h-28  rounded-3xl mr-8" src={{ $user->image }} alt="">
            <div class="flex flex-col items-start text-grey-600">
                <p class="text-sm flex items-center mb-2 gap-4">Username: {{ $user->username }}
                    <button class="text-sm text-blue-1200 hover:text-blue-500"
                        onclick="Livewire.emit('openModal', 'edit-username-modal', {username: '{{ $user->username }}'})">Edit</button>
                </p>

                @if ($user->id == Auth::user()->id)
                    <p class="text-sm flex items-center mb-2 gap-4">
                        Phone:
                        {{ $user->phone }}
                        <button class=" text-sm text-blue-1200 hover:text-blue-500"
                            onclick="Livewire.emit('openModal', 'edit-phone-modal', {phone: '{{ $user->phone }}'})">
                            @if ($user->phone != null)
                                Edit
                            @else
                                Input Phone Number
                            @endif
                        </button>
                    </p>
                    <p class="text-sm flex items-center mb-2 gap-4">
                        Date of Birth:
                        {{ $user->dob }}
                        <button class=" text-sm text-blue-1200 hover:text-blue-500"
                            onclick="Livewire.emit('openModal', 'edit-dob-modal', {dob: '{{ $user->dob }}'})">
                            @if ($user->dob != null)
                                Edit
                            @else
                                Input Date of Birth
                            @endif
                        </button>
                    </p>
                    <p class="text-sm flex items-center mb-2 gap-4">
                        Gender:
                        {{ $user->gender }}
                        <button class=" text-sm text-blue-1200 hover:text-blue-500"
                            onclick="Livewire.emit('openModal', 'edit-gender-modal', {gender: '{{ $user->gender }}'})">
                            @if ($user->gender != null)
                                Edit
                            @else
                                Input Gender
                            @endif
                        </button>
                    </p>
                @endif
            </div>
        </div>
        <div class="lg:ml-auto ">
            <div
                class="mb-4 mt-6 flex flex-row items-center justify-center  space-x-4 lg:ml-auto lg:mt-0 lg:justify-end">
                <div
                    class="group h-32 w-20  sm:h-56 sm:w-36 flex-shrink-0 cursor-pointer rounded-xl border border-transparent bg-blue-1000 p-2  text-center text-white transition-all hover:border-blue-1100 hover:text-blue-1200">
                    <div class="mb-2 flex items-center justify-center h-8 sm:h-24">
                        <i class="fa-solid fa-image-portrait fa-2x sm:fa-4x"></i>
                    </div>
                    <strong class="mb-2 block text-sm sm:text-2xl font-bold">{{ $user->posts_count }}</strong>
                    <div class="text-xs sm:text-sm leading-tight">Total <br>Posts</div>
                </div>
                <div
                    class="group h-32 w-20  sm:h-56 sm:w-36 flex-shrink-0 cursor-pointer rounded-xl border border-transparent bg-blue-1000 p-2 text-center text-white transition-all hover:border-blue-1100 hover:text-blue-1200">
                    <div class="mb-2 flex items-center justify-center h-8 sm:h-24">
                        <i class="fa-solid fa-comment fa-2x sm:fa-4x"></i>
                    </div>
                    <strong class="mb-2 block text-sm sm:text-2xl font-bold">{{ $user->replies_count }}</strong>
                    <div class="text-xs sm:text-sm leading-tight">Total <br>Replies</div>
                </div>
                <div
                    class="group h-32 w-20  sm:h-56 sm:w-36 flex-shrink-0 cursor-pointer rounded-xl border border-transparent bg-blue-1000 p-2 text-center text-white transition-all hover:border-blue-1100 hover:text-blue-1200">
                    <div class="mb-2 flex items-center justify-center h-8 sm:h-24">
                        <i class="fa-solid fa-heart fa-2x sm:fa-4x"></i>
                    </div>
                    <strong class="mb-2 block text-sm sm:text-2xl font-bold">{{ $user->likes_count }}</strong>
                    <div class="text-xs sm:text-sm leading-tight">Total <br>Likes</div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full hidden md:flex flex-wrap justify-center mt-10">
        @foreach ($achievements as $achievement)
            <x-achievement.achievement-tooltip :achievement="$achievement" />
        @endforeach
    </div>

    <div class="flex items-center text-xs font-bold uppercase mt-4">
        <span>Level {{ $user->level }}</span>
        <progress class="progress progress-primary mx-4 flex-1 rounded-full bg-black h-2" value="32"
            max="100"></progress>
        <span>{{ $user->xp }} XP</span>
    </div>
</div>
