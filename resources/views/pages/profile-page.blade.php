@extends('templates.template')

@section('content')
    <div class="relative w-full max-w-7xl mx-auto flex flex-col flex-grow items-center px-6 sm:px-16 text-white">
        <x-profile.profile-header :user="$user"/>
        <div class="flex flex-col items-center mt-20">
            <div class="mb-20">
                <p class="font-medium text-3xl">Activity</p>
            </div>
            @if ($user->posts_count == 0)
                <p class="text-5xl font-medium text-grey-600 mb-10">No Activity Yet</p>
                <i class="fa-solid fa-book fa-10x"></i>
            @endif
        </div>
    </div>
@endsection
