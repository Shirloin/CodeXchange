<div class="w-full h-full flex flex-grow p-4">
    <form wire:submit.prevent='register' method="POST" autocomplete="off"
        class="h-fit w-96 m-auto flex flex-col px-4 sm:px-8 py-4 sm:py-6 bg-container rounded-xl font-semibold text-sm text-grey-600">
        @csrf
        <h1 class="text-2xl font-bold mb-4">Sign Up</h1>
        <div class="mb-4">
            <label for="email">Email</label>
            <input wire:model='email'
                class=" w-full pt-1 pb-2  bg-transparent border-b-2 border-grey-600 focus:outline-none focus:ring-0 "
                placeholder="Enter Email" id="email" name="email" type="text" autocomplete="off">
        </div>
        <div class="mb-4">
            <label for="username">Username</label>
            <input wire:model='username'
                class=" w-full pt-1 pb-2  bg-transparent border-b-2 border-grey-600 focus:outline-none focus:ring-0 "
                placeholder="Enter Username" id="username" name="username" type="text" autocomplete="off">
        </div>
        <div class="mb-4">
            <label for="password">Password</label>
            <input wire:model='password'
                class="w-full pt-1 pb-2  bg-transparent border-b-2 border-grey-600 focus:outline-none focus:ring-0  "
                placeholder="Enter Password" id="password" name="password" type="password" autocomplete="off">
        </div>
        <button wire:loading.remove wire:target='register' type="submit"
            class="btn-blue-hover w-full rounded-md p-2 font-bold mt-4 mb-4">
            Register
        </button>
        <button wire:loading wire:target='register' class="btn-blue-hover w-full rounded-md p-2 font-bold mt-4 mb-4">
            @livewire('components.partial.loading-spinner')
        </button>
        <a href="/login" class="mx-auto mt-4 text-sm text-grey-600 hover:underline">Sign In</a>
    </form>
</div>
