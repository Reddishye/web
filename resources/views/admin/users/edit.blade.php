<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Permissions:</label>
                        <div x-data="{ permission: '', permissions: {{ json_encode(old('permissions', $user->permissions ?? [])) }} }" class="flex flex-col space-y-2">
                            <div class="flex space-x-2">
                                <input x-model="permission" @keydown.enter.prevent="if(permission.trim() !== '') { permissions.push(permission.trim()); permission = ''; }" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Add a permission">
                                <button @click.prevent="if(permission.trim() !== '') { permissions.push(permission.trim()); permission = ''; }" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    +
                                </button>
                            </div>
                            <div class="flex flex-wrap">
                                <template x-for="(permission, index) in permissions" :key="index">
                                    <div class="flex items-center bg-indigo-300 text-indigo-800 rounded-full px-3 py-1 mr-2 mb-2">
                                        <span x-text="permission"></span>
                                        <button @click.prevent="permissions.splice(index, 1)" class="ml-2 text-indigo-800 hover:text-indigo-900">
                                            &times;
                                        </button>
                                    </div>
                                </template>
                            </div>
                            <input type="hidden" name="permissions" :value="JSON.stringify(permissions)">
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Update User') }}
                        </button>
                    </div>
                </form>
                <x-section-border />
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Discord:</label>
                    @if ($user->discord_id)
                        <div class="flex items-center space-x-4">
                            <img src="{{ $user->discord_avatar_url }}" alt="Discord Avatar" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="text-gray-900">{{ $user->discord_username }}</p>
                                <p class="text-gray-600">{{ $user->discord_id }}</p>
                            </div>
                            <form action="{{ route('users.discord.unlink', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-red-600 hover:text-red-900">Unlink</button>
                            </form>
                        </div>
                    @else
                        <p class="text-gray-600">No Discord account linked.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
