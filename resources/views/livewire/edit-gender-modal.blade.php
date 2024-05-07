<div class="flex flex-col p-8 box-border text-grey-600">
    @if (Auth::user()->gender == null)
        <h1 class="font-semibold text-2xl mb-8">Pick Gender</h1>
    @else
        <h1 class="font-semibold text-2xl mb-8">Edit Gender</h1>
    @endif
    <form class="w-full flex flex-col" wire:submit.prevent='update'>
        <div class="w-full flex gap-4 mb-8">
            <button type="button"
                class="w-full p-2 rounded-md text-white 
                @if ($gender == 'Male') bg-blue-600 ring-0 
                @else ring-1 ring-grey-600 hover:bg-blue-600 hover:ring-0 @endif"
                wire:click="set('Male')">Male</button>
            <button type="button"
                class="w-full p-2 rounded-md text-white 
                @if ($gender == 'Female') bg-pink-600 ring-0 
                @else ring-1 ring-grey-600 hover:bg-pink-600 hover:ring-0 @endif"
                wire:click="set('Female')">Female</button>
            <button type="button"
                class="w-full p-2 rounded-md text-white
                @if ($gender == 'Other') bg-green-600 ring-0 
                @else ring-1 ring-grey-600 hover:bg-green-600 hover:ring-0 @endif"
                wire:click="set('Other')">Other</button>
        </div>
        <button
            class="font-bold text-sm w-full py-3 bg-panel-700 hover:text-grey-600 text-white rounded-xl transition-colors duration-300">Save</button>
    </form>
</div>
