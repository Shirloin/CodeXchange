<div x-data="{ show: false }" x-cloak>
    @if (Auth::user()->dob == null)
        <button x-on:click.prevent="show=true" class="text-sm text-blue-1200 hover:text-blue-500">Input Date of Birth
        </button>
    @else
        <button x-on:click.prevent="show=true" class="text-sm text-blue-1200 hover:text-blue-500">
            <i class="fas fa-edit"></i>
        </button>
    @endif

    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        x-show="show" x-transition:enter="transition ease-out duration-100 transform"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-on:click.prevent="show=false"
                class="fixed inset-0 bg-black bg-opacity-20 backdrop-blur-sm transition-opacity" aria-hidden="true">
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <form wire:submit.prevent='update'
                class="inline-block align-bottom bg-panel-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 text-grey-600">
                <div>
                    @if (Auth::user()->dob == null)
                        <h1 class="font-semibold text-3xl mb-10">Insert Date of Birth</h1>
                    @else
                        <h1 class="font-semibold text-3xl mb-10">Edit Date of Birth</h1>
                    @endif
                    <input wire:model.defer="dob"
                        class="w-full bg-transparent p-3 mb-4 ring-1 ring-grey-600 rounded-md focus:ring-grey-600 focus:outline-none focus:border-none"
                        type="date">
                </div>
                <button wire:loading.remove wire:target='update'
                    class="font-bold text-sm w-full px-8 py-3 bg-panel-700 hover:text-grey-600 text-white rounded-lg transition-colors duration-300">Save</button>
                <button wire:loading wire:target='update'
                    class="font-bold text-sm w-full px-8 py-3 bg-panel-700 hover:text-grey-600 text-white rounded-lg transition-colors duration-300">
                    @livewire('loading-spinner')
                </button>
            </form>
        </div>
    </div>
</div>
