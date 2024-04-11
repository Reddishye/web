<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Licenses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if (has_permission('admin'))
                        <div class="flex justify-end mb-4">
                            <x-button href="{{ route('licenses.create') }}">
                                {{ __('Create License') }}
                            </x-button>
                        </div>
                    @endif

                    <h3 class="text-lg font-medium mb-4">{{ __('Your Licenses') }}</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('License') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Project') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse (Auth::user()->licenses as $license)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $license->license }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $license->project }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                            @if ($license->locked)
                                                <i class="fas fa-times text-red-500"></i>
                                            @else
                                                <i class="fas fa-check text-green-500"></i>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('licenses.update', $license) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <x-button type="submit" name="regenerate">
                                                    <i class="fas fa-sync mr-1"></i>
                                                </x-button>
                                            </form>
                                            @if ($license->locked)
                                                <form action="{{ route('licenses.update', $license) }}" method="POST" class="inline ml-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-secondary-button type="submit" name="unlock">
                                                        <i class="fas fa-unlock mr-1"></i>
                                                    </x-secondary-button>
                                                </form>
                                            @else
                                                <form action="{{ route('licenses.update', $license) }}" method="POST" class="inline ml-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-danger-button type="submit" name="lock">
                                                        <i class="fas fa-lock mr-1"></i>
                                                    </x-danger-button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            {{ __('No licenses found for you.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if (has_permission('admin'))
                        <h3 class="text-lg font-medium mt-8 mb-4">{{ __('Other Licenses') }}</h3>

                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('License') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Project') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('User') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($licenses->where('user_id', '!=', Auth::id()) as $license)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $license->license }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $license->project }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $license->user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                @if ($license->locked)
                                                    <i class="fas fa-times text-red-500"></i>
                                                @else
                                                    <i class="fas fa-check text-green-500"></i>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form action="{{ route('licenses.update', $license) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-button type="submit" name="regenerate">
                                                        <i class="fas fa-sync mr-1"></i>
                                                    </x-button>
                                                </form>
                                                @if ($license->locked)
                                                    <form action="{{ route('licenses.update', $license) }}" method="POST" class="inline ml-2">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-secondary-button type="submit" name="unlock">
                                                            <i class="fas fa-unlock mr-1"></i>
                                                        </x-secondary-button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('licenses.update', $license) }}" method="POST" class="inline ml-2">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-danger-button type="submit" name="lock">
                                                            <i class="fas fa-lock mr-1"></i>
                                                        </x-danger-button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ __('No licenses found for other users.') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
