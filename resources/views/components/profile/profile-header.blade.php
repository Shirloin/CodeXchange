<div class="container mt-12">
    <div class="mx-auto lg:mx-0 lg:flex lg:max-w-full lg:items-center">
        <x-profile.profile-header-biodata :user="$user" />
        <div class="lg:ml-auto">
            <x-profile.profile-header-activity :user="$user" />
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
