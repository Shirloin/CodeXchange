<div class="relative inline-block" x-data="{ tooltip: false }" x-cloak>
    <div x-show="tooltip"
        class="w-56 absolute flex flex-col bg-panel-1000 text-white text-sm rounded-xl py-2 px-4 -translate-y-full -translate-x-3 -top-3">
        <span class="font-bold mb-2">{{ $achievement->name }}</span>
        <span class="text-xs font-medium">{{ $achievement->description }}</span>
    </div>
    <img class="md:w-16 lg:w-24 opacity-20 hover:opacity-100" src={{ $achievement->image }}
        x-on:mouseenter="tooltip = true" x-on:mouseleave="tooltip = false" alt="">
</div>
