<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 leading-tight">{{ __('Links') }}</h2>
            <a href="{{ route('links.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300 flex items-center">
                <i class="fas fa-plus mr-2"></i> Create Link
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Path</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Color</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($links as $link)
                            <tr class="hover:bg-gray-100 transition duration-300">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 select-all	">{{ $link->name }} <span class="px-2 ml-2 inline-block min-h-6 min-w-6 text-xs leading-5 font-semibold rounded-full bg-gray-200 border-2 select-none border-stone-300 text-gray-700"><i class="{{ $link->fa_icon }}"></i></span></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 border-dashed border-2 select-none ">{{ $link->path }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 select-all	"><span class="inline-block h-4 w-4 rounded-full" style="background-color: {{ $link->color }};"></span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <livewire:link.edit :link="$link" />
                                        <livewire:link.delete :link="$link" />
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
