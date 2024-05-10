<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodeXchange</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    @include('components.background')
    <div class="min-h-screen relative w-full flex flex-col justify-center z-20">
        {{ $slot }}
    </div>
    @livewire('components.footer')
    @livewireScripts
</body>

</html>
