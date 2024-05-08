<div>
    @if (Auth::user()->phone == null)
        <button class="text-sm text-blue-1200 hover:text-blue-500" onclick="edit_gender_modal.showModal()">Input Gender
        </button>
    @else
        <button class="text-sm text-blue-1200 hover:text-blue-500" onclick="edit_gender_modal.showModal()">Edit
        </button>
    @endif
    <dialog id="edit_gender_modal" class="modal">
        <form class="modal-box max-w-md bg-panel-800 text-grey-600" wire:submit.prevent='update'>
            @if (Auth::user()->gender == null)
                <h1 class="font-semibold text-3xl mb-10">Insert Gender</h1>
            @else
                <h1 class="font-semibold text-3xl mb-10">Edit Gender</h1>
            @endif
            <div class="w-full flex gap-4 mb-8">
                <button type="button"
                    class="w-full p-2 rounded-md text-white 
                    @if ($gender == 'Male') 
                    bg-blue-600 ring-0 
                    @else 
                    ring-1 ring-grey-600 hover:bg-blue-600 hover:ring-0
                     @endif"
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
            <button type="submit"
                class="font-bold text-sm w-full px-8 py-3 bg-panel-700 hover:text-grey-600 text-white rounded-lg transition-colors duration-300">Save</button>
        </form>
        <form method="dialog" class="modal-backdrop bg-blur">
            <button>close</button>
        </form>
    </dialog>
</div>
