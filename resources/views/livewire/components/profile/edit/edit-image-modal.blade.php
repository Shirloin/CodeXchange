<div class="group relative mr-4 sm:mr-8 w-24 h-24 sm:w-40 sm:h-40">
    @auth
        @csrf
        <label id="fileLabel" class="z-20 absolute inset-0 hidden group-hover:flex justify-center items-center text-white cursor-pointer"
            for="file">
            <input class="hidden" id="file" name="file" type="file" accept="image/jpeg, .jpeg, .jpg, image/png, .png" wire:model="file" wire:change.debounce.2000ms="update">
            <p class="text-2xs sm:text-sm">Edit Profile</p>
        </label>
    @endauth
    <img loading="lazy" class="w-24 h-24 sm:w-40 sm:h-40 absolute inset-0 rounded-3xl object-cover {{ auth()->check() ? 'group-hover:opacity-50' : '' }}"
        src="{{$image}}">
</div>