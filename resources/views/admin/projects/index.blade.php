<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 leading-tight">{{ __('Projects') }}</h2>
            <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300 flex items-center">
                <i class="fas fa-plus mr-2"></i> Create Project
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr class="select-none">
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Authors</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($projects as $project)
                            <tr class="hover:bg-gray-100 transition duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 select-all	">{{ $project->name }} <span class="px-2 ml-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 border-2 select-none border-stone-300 text-gray-700">{{ $project->version }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 border-dashed border-2 select-none @if ($project->status === 'active') border-green-200 @elseif ($project->status === 'inactive') border-red-200 @elseif ($project->status === 'archived') border-yellow-300 @elseif ($project->status === 'soon') border-orange-300 @endif">@if ($project->status === 'active') ⭐ Active @elseif ($project->status === 'inactive') 💀 Inactive @elseif ($project->status === 'archived') 📦 Archived @elseif ($project->status === 'soon') 👀 Soon @endif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 select-all	">{{ implode(', ', $project->authors) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <livewire:view-project-button :project="$project" />
                                        <livewire:edit-project-button :project="$project" />
                                        <livewire:delete-project-button :project="$project" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
