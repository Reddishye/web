<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold leading-tight text-gray-800">{{ __('Messages') }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold">Users</h3>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @foreach ($users as $user)
                            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                                <div class="flex items-center p-4 space-x-4">
                                    <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?s=50&d=identicon' }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full">
                                    <div>
                                        <a href="{{ route('messages.show', $user) }}" class="text-lg font-semibold text-gray-800 hover:text-blue-500">{{ $user->name }}</a>
                                        <p class="text-sm text-gray-600">Joined at {{ $user->created_at->format('M d, Y') }}</p>
                                        @if ($unreadMessagesCount[$user->id] > 0)
                                            <span class="text-sm font-semibold text-red-500">{{ $unreadMessagesCount[$user->id] }} unread message(s)</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-4 bg-gray-50">
                                    <a href="{{ route('messages.show', $user) }}" class="text-blue-500 hover:underline">View messages</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
