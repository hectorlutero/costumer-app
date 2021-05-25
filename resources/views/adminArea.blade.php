
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <h2>This page can be only seen by an Admin</h2>
                <div class="p-6 border-b border-gray-200">
                    <p class="h4 pl-3"> Hi there Admin {{ Auth::user()->name }}! </p>
                    <p class="h4 pl-3"> Your email is: {{ Auth::user()->email }} </p>
                    <p class="h4 pl-3"> You have permission as: @if (Auth::user()->hasRole('user')) user @elseif (Auth::user()->hasRole('administrator')) admin @endif </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
