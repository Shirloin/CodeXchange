<div x-show="show" class="z-10 fixed inset-0" x-transition:enter="transition ease-out duration-100 transform"
    x-transition:enter-start="opacity-100 translate-y-5" x-transition:enter-end="opacity-100 -translate-y-5"
    x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 -translate-y-5"
    x-transition:leave-end="opacity-100 translate-y-5">
    <div class="relative w-full h-full flex items-end text-white">
        <div class="mt-auto mx-auto max-w-3xl w-full">
            <form wire:submit.prevent='save' class="bg-[#1c3150] w-full px-6 py-4 flex flex-col rounded-xl">

                <div class="flex items-center mb-4">
                    <i class="fa-solid fa-reply mr-2"></i>
                    <p class="font-bold text-sm mr-2">{{ $msg }}
                        <span class="text-sky-600">
                            {{$to}}
                        </span>
                    </p>
                </div>
                <hr class="w-full border-b-[0.5] border-gray-500" />
                <textarea wire:model='content'
                    class="bg-transparent mb-1 border-none px-0 py-4 text-sm min-h-[175px] max-h-[45vh] break-words resize-none font-medium outline-none overflow-x-hidden overflow-y-auto"
                    placeholder="What's on your mind?" name="" id="" cols="30" rows="5"></textarea>
                <hr class="w-full border-b-[0.5] border-gray-500" />
                <div class="w-full flex justify-end my-4">
                    <div class="w-full md:w-fit flex text-sm font-semibold gap-4">
                        <button x-on:click.prevent='show=false'
                            class="w-full md:w-fit px-12 py-4 md:py-3 rounded-xl bg-blue-1300 hover:bg-blue-1400"
                            >Cancel</button>
                        <button type="submit"
                            class="w-full md:w-fit px-12 py-4 md:py-3 rounded-xl btn-blue-hover">Post</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
