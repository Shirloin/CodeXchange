@extends('templates.template')

@section('content')
    <div class="relative w-full  flex flex-col items-center flex-grow justify-start lg:gap-x-10 px-6 xl:px-16   text-white">
        <div class="mx-auto px-7 py-10">
            <div class="my-6 max-w-xl text-center ">
                <h1 class="mb-6 text-5xl text-white">Explore By Topic</h1>
                <p class="text-grey-700"> All CodeXchange are categorized into various topics. This should provide you with
                    an
                    alternate way to decide what to find
                    next, whether it be a particular framework, language, or tool.
                </p>
            </div>
        </div>
        <div
            class="max-w-6xl mx-auto mb-3 mt-8 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-x-4 gap-y-5 px-7 md:mt-16">
            @foreach ($topics as $topic)
                <a href=""
                    class="relative min-h-20 min-w-48 bg-container flex justify-between rounded-2xl px-3 py-1 mr-5">
                    <div class="flex flex-1 items-center">
                        <div class="mr-4 flex flex-shrink-0 justify-center">
                            <img width="50" height="50" src={{ $topic->image }} class="h-full" loading="lazy">
                        </div>
                        <div class="w-full lg:w-auto flex justify-between md:block">
                            <h2 class="text-left text-base font-semibold leading-tight">{{ $topic->name }}</h2>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
