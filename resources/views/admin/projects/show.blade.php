<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $project->name }}</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $project->description }}</p>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500"><strong>Status:</strong> {{ $project->status }}</p>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500"><strong>Authors:</strong> {{ implode(', ', $project->authors) }}</p>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Back to Projects') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
