<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit License') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">{{ __('Update License Information') }}</h3>

                    <form action="{{ route('licenses.update', $license) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="license" class="block text-gray-700 text-sm font-bold mb-2">{{ __('License') }}</label>
                            <input type="text" name="license" id="license" value="{{ $license->license }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="project" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Project') }}</label>
                            <input type="text" name="project" id="project" value="{{ $license->project }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="locked" class="inline-flex items-center">
                                <input type="checkbox" name="locked" id="locked" class="form-checkbox h-5 w-5 text-gray-600" {{ $license->locked ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700">{{ __('Locked') }}</span>
                            </label>
                        </div>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            {{ __('Update License') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
