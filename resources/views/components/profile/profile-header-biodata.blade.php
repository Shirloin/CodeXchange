<div class="flex justify-center">
    <livewire:edit-image-modal :image='$user->image' />

    <div class="flex flex-col items-start text-grey-600 text-sm sm:text-lg mb-4 sm:mb-0">
        <div class="h-8 sm:h-10 flex items-center gap-2">
            {{ $user->username }}
            @can('isMyProfile')
                <livewire:edit-username-modal :username='$user->username'>
                @endcan
        </div>
        @can('isMyProfile')
            <div class="h-8 sm:h-10 flex items-center gap-2">
                {{ $user->phone }}
                <livewire:edit-phone-modal :phone='$user->phone'>
            </div>
            <div class="h-8 sm:h-10 flex items-center gap-2">
                {{ $user->dob }}
                <livewire:edit-dob-modal :dob='$user->dob'>
            </div>
            <div class="h-8 sm:h-10 flex items-center gap-2">
                {{ $user->gender }}
                <livewire:edit-gender-modal :gender='$user->gender'>
            </div>
        @endcan
    </div>
</div>
