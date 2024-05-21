<div x-show="menu"
    class="fixed inset-0 h-screen flex flex-col justify-between bg-black z-50 p-10 text-white overflow-hidden"
    x-transition:enter="transform transition-transform duration-300" x-transition:enter-start="translate-x-full"
    x-transition:enter-end="translate-x-0" x-transition:leave="transform transition-transform duration-300"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
    <div class="flex justify-end">
        <button x-on:click="menu=false">
            <i class="fa-solid fa-xmark fa-2x"></i>
        </button>
    </div>
    <div class="flex flex-col flex-grow items-center justify-start mt-20 text-5xl  text-center font-medium">
        <a class="mb-10" href="/">Home <p class="text-sm italic text-gray-500 mt-3">// is where the PHP is</p></a>
        <a class="mb-10" href="/topic">Topics <p class="text-sm italic text-gray-500 mt-3">// just browsing?</p></a>
        <a class="mb-10" href="/library">Library <p class="text-sm italic text-gray-500 mt-3">// looking for something</p></a>
    </div>
    <div class="flex justify-center items-center gap-8 text-3xl font-medium">
        @auth
            <form action="/logout" method="POST">
                @csrf
                <button>Logout</button>
            </form>
        @endauth
        @guest
            <a class="hover:underline" href="/login">Sign In</a>
            <a class="hover:underline" href="/register">Sign Up</a>
        @endguest
    </div>
</div>
