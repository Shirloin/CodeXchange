<div>
    <button class="text-sm text-blue-1200 hover:text-blue-500 " onclick="edit_username_modal.showModal()">Edit
    </button>
    <dialog id="edit_username_modal" class="modal">
        <form class="modal-box max-w-md bg-panel-800 text-grey-600" wire:submit.prevent='update'>
            <h3 class="font-bold text-3xl mb-10">Edit Username</h3>
            <input wire:model.defer="username"
                class="w-full bg-transparent p-3 mb-6 ring-1 ring-grey-600 rounded-md focus:ring-grey-600 focus:outline-none"
                type="text" placeholder="Username" value={{ $username }}>
            <button
                class="font-bold text-sm w-full px-8 py-3 bg-panel-700 hover:text-grey-600 text-white rounded-lg transition-colors duration-300">Save</button>
        </form>
        <form method="dialog" class="modal-backdrop bg-blur">
            <button>close</button>
        </form> 
    </dialog>
</div>
