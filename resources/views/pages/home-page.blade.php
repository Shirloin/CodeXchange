@extends('template')
@section('content')
    <div class="max-w-7xl w-full mx-auto flex flex-grow  py-10 text-white">
        <div class="w-full h-fit flex justify-center">
            <div class="max-w-3xl w-full">
                @include('components.post.post-card')
                @include('components.post.post-card')
                @include('components.post.post-card')
                @include('components.post.post-card')
            </div>
        </div>
    </div>
@endsection
