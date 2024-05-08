<div>
    @if (Auth::user()->phone == null)
        <button class="text-sm text-blue-1200 hover:text-blue-500" onclick="edit_phone_modal.showModal()">Input Phone Number
        </button>
    @else
        <button class="text-sm text-blue-1200 hover:text-blue-500" onclick="edit_phone_modal.showModal()">Edit
        </button>
    @endif
    <dialog id="edit_phone_modal" class="modal">
        <form class="modal-box max-w-md bg-panel-800 text-grey-600" wire:submit.prevent='update'>
            @if (Auth::user()->phone == null)
                <h1 class="font-semibold text-3xl mb-10">Insert Phone</h1>
            @else
                <h1 class="font-semibold text-3xl mb-10">Edit Phone</h1>
            @endif
            <input wire:model.defer="phone"
                class="w-full bg-transparent p-3 mb-4 ring-1 ring-grey-600 rounded-md focus:ring-grey-600 focus:outline-none focus:border-none"
                value={{ $phone }} type="number" placeholder="089123456789">
            <button
                class="font-bold text-sm w-full px-8 py-3 bg-panel-700 hover:text-grey-600 text-white rounded-lg transition-colors duration-300">Save</button>
        </form>
        <form method="dialog" class="modal-backdrop bg-blur">
            <button>close</button>
        </form>
    </dialog>
</div>
