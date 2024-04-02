<div>
    <x-danger-button wire:click="confirmProjectDeletion" type="button" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </x-danger-button>

    <x-confirmation-modal wire:model="confirmingProjectDeletion">
        <x-slot name="title">
            Delete Project
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this project?
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingProjectDeletion')" class="mr-4" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="deleteProject" wire:loading.attr="disabled">
                Delete Project
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
