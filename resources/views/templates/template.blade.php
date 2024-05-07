<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodeXchange</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    @include('components.background')
    <div class="min-h-screen relative w-full flex flex-col justify-between z-20 overflow-hidden">
        <x-navbar />
        @yield('content')
    </div>
    <x-footer />
    @livewire('livewire-ui-modal')
    @livewireScripts
</body>

</html>
