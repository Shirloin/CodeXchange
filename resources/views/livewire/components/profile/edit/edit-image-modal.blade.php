<div class="group relative mr-8">
    <label
        class="z-20 absolute inset-0 w-full h-full justify-center items-center hidden group-hover:flex text-white cursor-pointer"
        for="file">
        <input wire:model='file' wire:change.debounce.2s='update' class="hidden" id="file" type="file"
            accept="image/*">
        <p>Edit Profile</p>
    </label>

    <img class="w-28 h-28 sm:w-40 sm:h-40  rounded-3xl object-cover  group-hover:opacity-50" src={{ $image }}>
</div>