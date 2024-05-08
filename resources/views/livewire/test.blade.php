<div x-data="{ show: false }">
    @if (Auth::user()->phone == null)
        <button x-on:click.prevent="show=true" class="text-sm text-blue-1200 hover:text-blue-500">Input Gender
        </button>
    @else
        <button x-on:click.prevent="show=true" class="text-sm text-blue-1200 hover:text-blue-500">Edit
        </button>
    @endif

    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        x-show="show">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-on:click.prevent="show=false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-panel-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 text-grey-600">
                <div>
                    @if (Auth::user()->gender == null)
                        <h1 class="font-semibold text-3xl mb-10">Insert Gender</h1>
                    @else
                        <h1 class="font-semibold text-3xl mb-10">Edit Gender</h1>
                    @endif
                    <div class="w-full flex gap-4 mb-8">
                        <button type="button"
                            class="w-full p-2 rounded-md text-white 
                            @if ($gender == 'Male') bg-blue-600 
                            @else 
                            ring-1 ring-grey-600 hover:bg-blue-600 hover:ring-0 @endif"
                            wire:click="set('Male')">Male</button>
                        <button type="button"
                            class="w-full p-2 rounded-md text-white 
                            @if ($gender == 'Female') bg-pink-600
                            @else ring-1 ring-grey-600 hover:bg-pink-600 hover:ring-0 @endif"
                            wire:click="set('Female')">Female</button>
                        <button
                            class="w-full p-2 rounded-md text-white
                                @if ($gender == 'Other') bg-green-600 
                                @else ring-1 ring-grey-600 hover:bg-green-600 hover:ring-0 @endif"
                            wire:click="set('Other')" type="button">Other</button>
                    </div>
                </div>
                <button type="submit"
                class="font-bold text-sm w-full px-8 py-3 bg-panel-700 hover:text-grey-600 text-white rounded-lg transition-colors duration-300">Save</button>
            </div>
        </div>
    </div>
</div>
