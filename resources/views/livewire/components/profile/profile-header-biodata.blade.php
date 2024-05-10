<div class="flex justify-center">
    @livewire('profile.edit-image-modal', ['image' => $user->image])

    <div class="flex flex-col items-start text-grey-600 text-sm sm:text-lg mb-4 sm:mb-0">
        <div class="h-8 sm:h-10 flex items-center gap-2">
            {{ $user->username }}
            @if ($user->id == Auth::user()->id)
            @endif
            @can('isMyProfile', $user)
                @livewire('profile.edit-username-modal', ['username' => $user->username])
            @endcan
        </div>
        @can('isMyProfile', $user)
            <div class="h-8 sm:h-10 flex items-center gap-2">
                {{ $user->phone }}
                @livewire('profile.edit-phone-modal', ['phone' => $user->phone])
            </div>
            <div class="h-8 sm:h-10 flex items-center gap-2">
                {{ $user->dob }}
                @livewire('profile.edit-dob-modal', ['dob' => $user->dob])
            </div>
            <div class="h-8 sm:h-10 flex items-center gap-2">
                {{ $user->gender }}
                @livewire('profile.edit-gender-modal', ['gender' => $user->gender])
            </div>
        @endcan
    </div>
</div>
