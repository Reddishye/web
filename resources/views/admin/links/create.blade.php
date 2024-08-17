<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Link') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('links.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="path" class="block text-gray-700 text-sm font-bold mb-2">Path</label>
                            <input type="text" name="path" id="path" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('path') border-red-500 @enderror" value="{{ old('path') }}" required autofocus>
                            @error('path')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="link" class="block text-gray-700 text-sm font-bold mb-2">URL</label>
                            <textarea name="link" id="link" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('link') border-red-500 @enderror" required>{{ old('link') }}</textarea>
                            <p class="text-gray-600 text-xs italic mt-2">You can use the following special prefixes:</p>
                            <ul class="text-gray-600 text-xs italic mt-1 ml-4 list-disc">
                                <li><code>copy:&lt;text_to_copy&gt;</code> - Copies the specified text to clipboard</li>
                                <li><code>newwindow:&lt;url&gt;</code> - Opens the specified URL in a new window</li>
                                <li><code>route:&lt;route_name&gt;</code> - Redirects to the specified route</li>
                                <li><code>onlyview</code> - Disables the link (for display only)</li>
                            </ul>
                            @error('link')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="fa_icon" class="block text-gray-700 text-sm font-bold mb-2">Icon</label>
                            <input type="text" name="fa_icon" id="fa_icon" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('fa_icon') border-red-500 @enderror" value="{{ old('fa_icon') }}" required>
                            <p class="text-gray-600 text-xs italic mt-2">Remember to add fas, fa-brands or whatever before the name of the icon.</p>
                            @error('icon')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="color" class="block text-gray-700 text-sm font-bold mb-2">Color</label>
                            <input type="color" name="color" id="color" class="shadow appearance-none border rounded w-full py-2 px-3 h-8 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('color') border-red-500 @enderror" value="{{ old('color') }}" required autofocus>
                            @error('color')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Create Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
