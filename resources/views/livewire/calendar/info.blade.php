<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('Event Information') }}
        </x-slot>

        <x-slot name="content">
            @if($event)
                @if(has_permission('admin') || $isEventOwner)
                    <!-- Formulario editable -->
                    <div class="mt-4">
                        <x-label for="title" value="{{ __('Title') }}" />
                        <x-input id="title" type="text" class="mt-1 block w-full" wire:model="title"/>
                        @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" class="mt-1 block w-full" wire:model="description"></textarea>
                        @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="start_time" value="{{ __('Start Time') }}" />
                        <x-input id="start_time" type="datetime-local" class="mt-1 block w-full" wire:model="start_time"/>
                        @error('start_time') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="end_time" value="{{ __('End Time') }}" />
                        <x-input id="end_time" type="datetime-local" class="mt-1 block w-full" wire:model="end_time"/>
                        @error('end_time') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <x-label for="status" value="{{ __('Status') }}" />
                        <select id="status" class="mt-1 block w-full" wire:model="status">
                            <option value="pending">Pending</option>
                            <option value="accepted">Accepted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="type" value="{{ __('Type') }}" />
                        <select id="type" class="mt-1 block w-full" wire:model="type">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                        @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                @else
                    <!-- Tabla en modo solo lectura -->
                    @if($event->type === 'public')
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <td>{{ $event->title }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Description') }}</th>
                                    <td>{{ $event->description }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Start Time') }}</th>
                                    <td>{{ $event->start_time }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('End Time') }}</th>
                                    <td>{{ $event->end_time }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @elseif($event->type === 'private')
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody>
                                <tr>
                                    <th>{{ __('Start Time') }}</th>
                                    <td>{{ $event->start_time }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('End Time') }}</th>
                                    <td>{{ $event->end_time }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p>{{ __('You do not have permission to view this event.') }}</p>
                    @endif
                @endif
            @else
                <p>{{ __('No event selected.') }}</p>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal">
                {{ __('Exit') }}
            </x-secondary-button>

            @if($isEventOwner)
                <x-danger-button wire:click="delete" class="ml-2">
                    {{ __('Delete') }}
                </x-danger-button>
            @endif

            @if(has_permission('admin'))
                <x-button class="ml-2" wire:click="save">
                    {{ __('Save') }}
                </x-button>
            @endif
        </x-slot>
    </x-dialog-modal>
</div>
