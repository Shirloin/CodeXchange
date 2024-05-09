<div class="relative z-10 w-full flex justify-between items-center px-6 py-4 text-white">
    <a href="/" class="text-2xl font-semibold ">CodeXchange</a>
    <div class="hidden md:flex justify-center items-center gap-12 text-md font-medium">
        <a href="/" class="group relative">
            HOME
            <span class="underline-animation"></span>
        </a>
        <a href="/topic" class="group relative ">
            TOPIC
            <span class="underline-animation"></span>
        </a>
        <a href="/library" class="group relative ">
            LIBRARY
            <span class="underline-animation"></span>
        </a>
    </div>
    <div class="hidden md:flex items-center gap-4 text-sm font-semibold">
        @guest
            <a href="/login"
                class=" bg-panel-1000 px-8 py-3 rounded-md hover:text-grey-600 transition-colors duration-300">Sign In</a>
            <a href="/register" class="btn-blue-hover px-8 py-3 rounded-md ">Sign Up</a>
        @endguest
        @auth
            <a href="/profile/{{ Auth::user()->id }}" class="mr-4 flex items-center p-2 rounded-xl">
                <img class=" w-10 h-10 rounded-full object-cover" src={{ Auth::user()->image }} alt=""
                    loading="lazy">
            </a>
            <form action="/logout" method="post">
                @csrf
                <button class="flex bg-container items-center px-6 py-3 rounded-lg ">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-lg mr-2"></i>
                    <p class="text-md">Log Out</p>
                </button>
            </form>
        @endauth

    </div>
    <div class="flex md:hidden">
        <button>
            <i class="fa-solid fa-bars fa-xl"></i>
        </button>
    </div>
</div>
