<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-4">
            <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?s=50&d=identicon' }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full"> <h2 class="text-2xl font-semibold text-gray-800 leading-tight">{{ __('Conversation with ') . $user->name }}</h2>
            <a href="{{ route('messages.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Go back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @livewire('chat', ['user' => $user])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
