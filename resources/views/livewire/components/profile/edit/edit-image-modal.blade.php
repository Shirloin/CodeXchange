<div class="group relative mr-4 sm:mr-8 w-24 h-24 sm:w-40 sm:h-40 ">
    <label class="z-20 absolute inset-0 hidden group-hover:flex justify-center items-center  text-white cursor-pointer"
        for="file">
        <input wire:model='file' wire:change.debounce.2s='update' class="hidden" id="file" type="file"
            accept="image/*">
        <p class="text-2xs sm:text-sm">Edit Profile
        </p>
    </label>

    <img class="absolute inset-0 rounded-3xl object-cover  group-hover:opacity-50" src={{ $image }}>
</div>
