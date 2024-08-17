<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold leading-tight text-gray-800">{{ __('Calendar') }}</h2>
            @livewire('calendar.create')
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <livewire:calendar
                        :day-click-enabled="false"
                        :event-click-enabled="true"
                        :drag-and-drop-enabled="false"
                    />
                    <livewire:calendar.info />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
