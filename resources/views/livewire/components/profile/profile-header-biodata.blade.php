<div class="flex justify-center">
    @livewire('components.profile.edit.edit-image-modal', ['image' => $user->image])
    <div class="flex flex-col items-start text-grey-600 text-sm sm:text-lg mb-4 sm:mb-0">
        <div class="h-8 sm:h-10 flex items-center gap-2">
            {{ $user->username }}
            @can('isMyProfile', $user)
                @livewire('components.profile.edit.edit-username-modal', ['username' => $user->username])
            @endcan
        </div>
        @can('isMyProfile', $user)
            <div class="h-8 sm:h-10 flex items-center gap-2">
                {{ $user->phone }}
                @livewire('components.profile.edit.edit-phone-modal', ['phone' => $user->phone])
            </div>
            <div class="h-8 sm:h-10 flex items-center gap-2">
                {{ $user->dob }}
                @livewire('components.profile.edit.edit-dob-modal', ['dob' => $user->dob])
            </div>
            <div class="h-8 sm:h-10 flex items-center gap-2">
                {{ $user->gender }}
                @livewire('components.profile.edit.edit-gender-modal', ['gender' => $user->gender])
            </div>
        @endcan
    </div>
</div>
