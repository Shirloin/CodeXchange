<div class="flex flex-col p-8 box-border text-grey-600">
    @if (Auth::user()->dob == null)
        <h1 class="font-semibold text-2xl mb-8">Insert Date of Birth</h1>
    @else
        <h1 class="font-semibold text-2xl mb-8">Edit Date of Birth</h1>
    @endif
    <form class="w-full flex flex-col" wire:submit.prevent='update'>
        <input wire:model="dob"
            class="w-full bg-transparent p-3 mb-4 ring-1 ring-grey-600 rounded-md focus:ring-grey-600 focus:outline-none focus:border-none" type="date">
        <button
            class="font-bold text-sm w-full py-3 bg-panel-700 hover:text-grey-600 text-white rounded-xl transition-colors duration-300">Save</button>
    </form>
</div>
