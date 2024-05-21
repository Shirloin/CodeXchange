<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodeXchange</title>
    <link rel="icon" type="image/x-icon" href="/assets/logo.png">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<style>
    [x-cloak] {
        display: none
    }
</style>

<body x-data="{menu:false}" x-cloak>
    @include('components.background')
    @livewire('components.partial.menu')
    <div class="min-h-screen relative w-full flex flex-col justify-between z-20 ">
        @livewire('components.navbar')
        {{ $slot }}
    </div>
    @livewire('components.footer')
    @livewireScripts
</body>

</html>
