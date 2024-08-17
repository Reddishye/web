<div>
    <x-button wire:click="openModal">
        {{ __('Create Event') }}
    </x-button>

    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('Create Event') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" type="text" class="mt-1 block w-full" wire:model="title" />
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-label for="description" value="{{ __('Description') }}" />
                <textarea id="description" class="mt-1 block w-full" wire:model="description"></textarea>
                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-label for="start_time" value="{{ __('Start Time') }}" />
                <x-input id="start_time" type="datetime-local" class="mt-1 block w-full" wire:model="start_time" />
                @error('start_time') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-label for="end_time" value="{{ __('End Time') }}" />
                <x-input id="end_time" type="datetime-local" class="mt-1 block w-full" wire:model="end_time" />
                @error('end_time') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            @if (has_permission('admin'))
                <div class="mt-4">
                    <x-label for="status" value="{{ __('Status') }}" />
                    <select id="status" class="mt-1 block w-full" wire:model="status">
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            @endif
            @if (has_permission('admin'))
            <div class="mt-4">
                <x-label for="type" value="{{ __('Type') }}" />
                <select id="type" class="mt-1 block w-full" wire:model="type">

                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
                @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            @endif
            @if (!has_permission('admin'))
            <!-- NOTES BELOW THE MODAL -->
            <p class="mt-4 text-sm text-gray-500 italic">
                {{ __('* After this, the event will be marked as pending and Redactado will have to accept it.') }}
            </p>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="save">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
