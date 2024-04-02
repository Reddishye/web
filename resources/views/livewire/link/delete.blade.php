<div>
    <x-danger-button wire:click="confirmLinkDeletion" type="button" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </x-danger-button>

    <x-confirmation-modal wire:model="confirmingLinkDeletion">
        <x-slot name="title">
            Delete Link
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this link?
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingLinkDeletion')" class="mr-4" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="deleteLink" wire:loading.attr="disabled">
                Delete Link
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
