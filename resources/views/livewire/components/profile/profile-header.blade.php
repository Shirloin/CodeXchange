<div class="container mt-12">
    <div class="mx-auto lg:mx-0 lg:flex lg:max-w-full lg:items-center">
        @livewire('components.profile.profile-header-biodata', ['user' => $user])
        <div class="lg:ml-auto">
            @livewire('components.profile.profile-header-activity', ['user' => $user])
        </div>
    </div>
    <div class="w-full hidden md:flex flex-wrap justify-center mt-10">
        @foreach ($achievements as $achievement)
            @livewire('components.profile.achievement-tooltip', ['achievement' => $achievement, 'user' => $user])
        @endforeach
    </div>

    <div class="flex items-center text-xs font-bold uppercase mt-4">
        <span>Level {{ $user->level }}</span>
        <progress class="progress flex-1 mx-4 h-2" value={{ $user->xp }} max="5000"></progress>
        <span>{{ $user->xp }} XP</span>
    </div>
</div>
