<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('License Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">{{ __('License Information') }}</h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ __('License') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $license->license }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ __('Product') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $license->project }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ __('Creation Date') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $license->creationDate }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ __('User') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $license->user->name }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ __('Locked') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $license->locked ? 'Yes' : 'No' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3 class="text-lg font-medium mt-8 mb-4">{{ __('License Log') }}</h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Event') }}</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('IP Address') }}</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Timestamp') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($license->logs()->latest()->take(15)->get() as $log)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($log->event === 'License accessed')
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                        @elseif ($log->event === 'License is locked')
                                            <i class="fas fa-lock text-red-500 mr-2"></i>
                                        @elseif ($log->event === 'Rate limit exceeded')
                                            <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
                                        @else
                                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                        @endif
                                        {{ $log->event }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->ip_address }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->timestamp }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if (has_permission('licenses'))
                        <div class="mt-6 flex space-x-2">
                            <x-button href="{{ route('licenses.edit', $license) }}">
                                {{ __('Edit License') }}
                            </x-button>

                            <form action="{{ route('licenses.destroy', $license) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this license?') }}')">
                                @csrf
                                @method('DELETE')
                                <x-danger-button type="submit">
                                    {{ __('Delete License') }}
                                </x-danger-button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
